<?php
namespace App\Livewire\Admin;

use App\Models\Catalog;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CatalogList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Catalog::query()->where('shop_id', auth()->user()->shop->id))->headerActions(
            [
                CreateAction::make('new')->label('New Catalog')->icon('heroicon-o-plus-circle')->modalWidth('lg')->action(
                    fn($data) => Catalog::create([
                        'shop_id' => auth()->user()->shop->id,
                        'name'    => $data['name'],
                    ])
                )->form([
                    TextInput::make('name')->required(),
                ]),
            ]
        )->columns([
            TextColumn::make('name')->label('NAME')->searchable(),
            TextColumn::make('id')->label('TOTAL SERVICES')->badge()->color('successk')->formatStateUsing(
                fn($record) => $record->catalogServices->count()
            )->searchable(),
        ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('services')
                    ->label('Services')
                    ->icon('heroicon-o-cog')
                    ->button()
                    ->color('warning')
                    ->outlined()
                    ->form(fn($record) => [ // Dynamically fetch data each time
                        Repeater::make('catalogServices')
                            ->label('')
                            ->schema([
                                TextInput::make('name')->required(),
                                TextInput::make('price')
                                    ->label('Price (per KG)')
                                    ->prefix('₱')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Service')
                            ->default($record->catalogServices->map(fn($service) => [
                                'name'  => $service->name,
                                'price' => $service->price,
                            ])->toArray()), // Prepopulate from database
                    ])
                    ->modalHeading(fn($record) => ($record ? $record->name . ' Catalog' : 'Catalog'))
                    ->slideOver()
                    ->before(function ($action, $record) {
                        // Preload existing catalog services into the repeater field
                        $action->form([
                            'catalogServices' => $record->catalogServices->map(fn($service) => [
                                'name'  => $service->name,
                                'price' => $service->price,
                            ])->toArray(),
                        ]);
                    })
                    ->action(function ($record, $data, $action) {
                        // Delete existing services before inserting new ones
                        $record->catalogServices()->delete();

                        // Ensure 'catalogServices' exists before inserting
                        if (! empty($data['catalogServices'])) {
                            $record->catalogServices()->createMany($data['catalogServices']);
                        }

                        // Keep modal open
                        $action->hold();

                        // Show success notification
                        Notification::make()
                            ->title('Services updated successfully!')
                            ->success()
                            ->send();
                    }),
                EditAction::make('edit')->color('success')->modalWidth('lg')->form([
                    TextInput::make('name')->required(),
                ]),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.catalog-list');
    }
}
