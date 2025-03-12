<?php

namespace App\Livewire\Staff;

use App\Models\ArrivalQueue;
use App\Models\Catalog;
use App\Models\CatalogService;
use App\Models\ServiceTransaction;
use App\Models\ServiceType;
use Carbon\Carbon;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Enum\Packs\Position;

class ServiceTransactionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $catalogs = [];
    public $service_type_id;
    public $service_name;



    public function mount()
    {
        $this->service_type_id = request('id');
        $this->service_name = ServiceType::where('id', $this->service_type_id)->first()->name;
    }




    public function table(Table $table): Table
    {
        return $table
            ->query(ServiceTransaction::query()->where('shop_id', auth()->user()->staff->shop_id)->where('service_type_id', $this->service_type_id)->orderByDesc('created_at'))
            ->columns([
                Split::make([
                    TextColumn::make('created_at')->label('PENDING ' . strtoupper($this->service_name) . ' ORDERS')
                        ->formatStateUsing(
                            fn($record) =>
                            'ORDER #' . $record->id . '  |  ' .
                            Carbon::parse($record->created_at)->format('h:i A') . ' - ' .
                            Carbon::parse($record->created_at)->format('F d, Y')
                        )
                        ->html(),
                    TextColumn::make('status')->formatStateUsing(
                        fn($record) => ucfirst($record->status)
                    )->badge()->color(fn(string $state): string => match ($state) {
                            'pending' => 'warning',
                            'accepted' => 'success',
                            'Completed' => 'success',
                            'placed order' => 'info',
                            'cancelled' => 'danger',
                        }),
                ])->from('md'),

            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('accept')->color('success')->size('xs')->icon('heroicon-m-hand-thumb-up')->action(
                        function ($record) {
                            if ($record->service_type_id == 1) {
                                $record->update([
                                    'is_accepted' => true,
                                    'status' => 'accepted'
                                ]);
                            } else {
                                $record->update([
                                    'is_accepted' => true,
                                    'status' => 'accepted',
                                    'is_on_the_way' => true,
                                    'is_arrived' => true
                                ]);
                            }

                        }
                    )->hidden(fn($record) => $record->status == 'cancelled'),
                    Action::make('reject')->color('danger')->size('xs')->icon('heroicon-m-hand-thumb-down'),
                ])->hidden(fn($record) => $record->status != 'pending'),
                Action::make('on_the_way')->hidden(fn($record) => $record->is_on_the_way || $record->service_type_id == 2 || $record->status == 'cancelled')->disabled(fn($record) => $record->is_accepted == false)->button()->color('warning')->size('xs')->icon('heroicon-o-arrow-long-right')->iconPosition(IconPosition::After)->action(
                    function ($record) {
                        $record->update([
                            'is_on_the_way' => true,
                        ]);

                        ArrivalQueue::create([
                            'shop_id' => $record->shop_id,
                            'user_id' => $record->user_id,
                        ]);
                    }
                ),
                Action::make('arrive')->hidden(fn($record) => $record->is_arrived || $record->service_type_id == 2 || $record->status == 'cancelled')->disabled(fn($record) => $record->is_on_the_way == false)->button()->color('info')->size('xs')->icon('heroicon-o-home-modern')->iconPosition(IconPosition::After)->action(
                    function ($record) {
                        $record->update([
                            'is_arrived' => true,
                        ]);
                        ArrivalQueue::where('shop_id', $record->shop_id)->where('user_id', $record->user_id)->delete();
                    }
                ),
                Action::make('order_form')->hidden(
                    fn($record) => $record->status == 'placed order' || $record->status == 'pending' || $record->status == 'Completed' || $record->status == 'cancelled'
                )
                    ->label('Order Form')->button()->size('xs')->icon('heroicon-s-document-text')->iconPosition(IconPosition::After)->url(fn($record) => route('staff.order-form', ['id' => $record->id])),
                Action::make('order_detail')->label('Order Detail')->visible(
                    fn($record) => $record->status == 'placed order' || $record->status == 'Completed'
                )->button()->size('xs')->icon('heroicon-s-ticket')->iconPosition(IconPosition::After)->url(fn($record) => route('staff.order-detail', ['id' => $record->id]))
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.staff.service-transaction-list');
    }
}
