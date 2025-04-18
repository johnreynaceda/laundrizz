<?php
namespace App\Livewire;

use App\Models\Shop;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Cart extends Component implements HasForms
{
    use InteractsWithForms;
    public $image = [];
    public $payment_image = [], $reference_number;

    public $permit = [];
    public $identification = [];

    public $get_subscription;

    public $selected_subscription;

    public $name, $description, $address, $phone_number;

    public function updatedGetSubscription()
    {
        $this->selected_subscription = Subscription::where('id', $this->get_subscription)->first();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('LAUNDRY SHOP INFORMATION')->icon('heroicon-s-building-storefront')
                    ->description('Please input the required fields.')->collapsed()
                    ->schema([
                        FileUpload::make('image')->label('Shop Image'),
                        ViewField::make('rating')
                            ->view('filament.forms.empty'),
                        TextInput::make('name')->label('Shop Name'),
                        TextInput::make('description')->label('Shop Description'),
                        TextInput::make('address')->label('Shop Address'),
                        TextInput::make('phone_number')->label('Phone Number'),
                        FileUpload::make('permit')->label('Business Permit'),
                        FileUpload::make('identification')->label('Identification'),
                    ])->columns(2),
                Section::make('PAYMENT')->icon('heroicon-s-credit-card')
                    ->description('Please upload the payment information')->collapsed()
                    ->schema([
                        FileUpload::make('payment_image')->label('Image'),
                        ViewField::make('rating')
                            ->view('filament.forms.qr_payment'),
                        TextInput::make('reference_number')->label('Reference Number')->numeric(),

                    ])->columns(2),
            ]);
    }

    public function applySubscription()
    {

        $this->validate([
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric|digits_between:1,11',
            'payment_image' => 'required',
            'permit' => 'required',
            'identification' => 'required',
            'reference_number' => 'required',
        ]);

        $shop = [];

        foreach ($this->image as $key => $value) {
            $shop = Shop::create([
                'name' => $this->name,
                'description' => $this->description,
                'address' => $this->address,
                'contact' => $this->phone_number,
                'image_path' => encrypt($value->store('Shop', 'public')),
                'subscription_id' => $this->get_subscription,
                'user_id' => auth()->user()->id,
            ]);

            foreach ($this->payment_image as $key => $image) {
                SubscriptionPayment::create([
                    'shop_id' => $shop->id,
                    'subscription_id' => $this->get_subscription,
                    'amount' => $this->selected_subscription->amount,
                    'reference_number' => $this->reference_number,
                    'payment_image_path' => encrypt($image->store('Payment', 'public')),
                ]);
            }

        }
        foreach ($this->permit as $key => $permit) {
            $shop->update([
                'business_permit_path' => encrypt($permit->store('Permit', 'public')),
            ]);
        }
        foreach ($this->identification as $key => $identification) {
            $shop->update([
                'identification_path' => encrypt($identification->store('Identification', 'public')),
            ]);
        }

        return redirect()->route('dashboard');

    }

    public function render()
    {
        return view('livewire.cart', [
            'subscriptions' => Subscription::get(),
        ]);
    }
}
