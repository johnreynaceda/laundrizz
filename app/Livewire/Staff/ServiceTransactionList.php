<?php

namespace App\Livewire\Staff;

use App\Models\ServiceTransaction;
use App\Models\ServiceType;
use Carbon\Carbon;
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

    public $service_type_id;
    public $service_name;
    public function mount(){
        $this->service_type_id = request('id');
        $this->service_name = ServiceType::where('id', $this->service_type_id)->first()->name;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ServiceTransaction::query()->where('shop_id', auth()->user()->staff->shop_id)->where('service_type_id', $this->service_type_id))
            ->columns([
               Split::make([
                TextColumn::make('created_at')->label('PENDING '. strtoupper($this->service_name) .' ORDERS')
                ->formatStateUsing(fn($record) => 
                    'ORDER #' . $record->id .  '  |  ' . 
                    Carbon::parse($record->created_at)->format('h:i A') . ' - ' . 
                    Carbon::parse($record->created_at)->format('F d, Y')
                )
                ->html(),
               ])->from('md')
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('accept')->color('success')->size('xs')->icon('heroicon-m-hand-thumb-up')->action(
                        fn($record) => $record->update([ 'is_accepted' => true,
                        'status' => 'accepted',]),
                    ),
                Action::make('reject')->color('danger')->size('xs')->icon('heroicon-m-hand-thumb-down'),
                ])->hidden(fn($record) => $record->status != 'pending' ),
                Action::make('on_the_way')->disabled(fn($record) => $record->is_accepted == false)->button()->color('warning')->size('xs')->icon('heroicon-o-arrow-long-right')->iconPosition(IconPosition::After),
                Action::make('arrive')->disabled(fn($record) => $record->is_on_the_way == false)->button()->color('info')->size('xs')->icon('heroicon-o-home-modern')->iconPosition(IconPosition::After)
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
