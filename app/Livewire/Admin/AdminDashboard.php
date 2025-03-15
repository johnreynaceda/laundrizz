<?php

namespace App\Livewire\Admin;

use App\Models\OrderDetail;
use App\Models\Subscription;
use Carbon\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AdminDashboard extends Component implements HasForms
{
    use InteractsWithForms;

    public $showRenewModal = false;
    public $selectedSubscriptionId;

    public $subsription;

    public $payments = [];
    public $reference_number;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('payments')->required(),
                TextInput::make('reference_number')->required()
            ]);
    }


    public function confirmRenew($subscriptionId)
    {
        $this->selectedSubscriptionId = $subscriptionId;
        $this->subsription = Subscription::find($subscriptionId)->name;

        $this->showRenewModal = true;
    }

    public function renewSubscription()
    {
        $shop = auth()->user()->shop;

        if ($shop) {
            // Find the latest expired subscription for the selected plan
            $previousSubscription = $shop->subscriptionPayments()
                ->latest('updated_at')
                ->first();

            if ($previousSubscription) {
                // Mark previous subscription as expired (just in case)
                $previousSubscription->update(['is_expired' => true]);

                // Fetch subscription details
                $subscription = $previousSubscription->subscription;

                if ($subscription) {
                    // Create a new payment entry for the renewed subscription
                    foreach ($this->payments as $key => $value) {
                        $newSubscriptionPayment = $shop->subscriptionPayments()->create([
                            'shop_id' => $shop->id,
                            'subscription_id' => $this->selectedSubscriptionId,
                            'amount' => Subscription::find($this->selectedSubscriptionId)->amount,
                            'payment_image_path' => $value->store('Payment', 'public'),
                        ]);
                    }

                    // Optionally, you can log or return success message
                }
            }
        }

        // Close modal
        $this->showRenewModal = false;

    }


    public function mount()
    {
        $shop = auth()->user()->shop;

        if ($shop) {
            // Get the latest active subscription with the subscription relation loaded
            $latestSubscription = $shop->subscriptionPayments()
                ->where('is_paid', true)
                ->where('is_expired', false)
                ->with('subscription') // Ensure we load the related subscription
                ->orderByDesc('updated_at')
                ->first();

            // Ensure subscription data exists before accessing properties
            if ($latestSubscription && $latestSubscription->subscription) {
                $subscriptionMonths = $latestSubscription->subscription->month; // Get the subscription duration

                // Calculate expiration date
                $expirationDate = Carbon::parse($latestSubscription->updated_at)->addMonths($subscriptionMonths);

                // Calculate remaining days
                $remainingDays = Carbon::now()->diffInDays($expirationDate, false);

                // Debugging output
                // dd([
                //     'latestSubscription' => $latestSubscription,
                //     'subscriptionExists' => $latestSubscription->subscription,
                //     'updated_at' => $latestSubscription->updated_at,
                //     'subscription_months' => $subscriptionMonths,
                //     'calculated_expiration' => $expirationDate,
                //     'current_time' => Carbon::now(),
                //     'remaining_days' => $remainingDays,
                //     'is_expired_check' => Carbon::now()->greaterThanOrEqualTo($expirationDate),
                // ]);

                // Mark as expired if needed
                if (Carbon::now()->greaterThanOrEqualTo($expirationDate)) {
                    $latestSubscription->update(['is_expired' => true]);
                    $latestSubscription->shop->update([
                        'is_active' => false,
                    ]);
                }
            }
        }


    }



    public function render()
    {
        return view('livewire.admin.admin-dashboard', [
            'sales' => OrderDetail::whereHas('serviceTransaction', function ($record) {
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed');
            })->where('is_complete', true)->get(),
            'today' => OrderDetail::whereHas('serviceTransaction', function ($record) {
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed');
            })->where('is_complete', true)->whereDate('created_at', now())->get(),
            'pickup' => OrderDetail::whereHas('serviceTransaction', function ($record) {
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed')->where('service_type_id', 1);
            })->where('is_complete', true)->whereDate('created_at', now())->count(),
            'dropoff' => OrderDetail::whereHas('serviceTransaction', function ($record) {
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed')->where('service_type_id', 2);
            })->where('is_complete', true)->whereDate('created_at', now())->count(),
            'subscriptions' => Subscription::get(),
        ]);
    }
}
