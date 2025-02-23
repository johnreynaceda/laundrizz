<?php
namespace App\Livewire\Superadmin;

use App\Models\Shop;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShopList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Shop::query())->columns([
            Stack::make([
                ViewColumn::make('image')->view('filament.tables.shop_image'),
                TextColumn::make('name')->weight(FontWeight::Bold)->formatStateUsing(
                    fn($record) => strtoupper($record->name)
                )->color('success'),
                TextColumn::make('description'),
                ViewColumn::make('status')->view('filament.tables.status'),
            ]),
        ])
            ->filters([
                // ...
            ])
            ->actions([
                ViewAction::make('view')->badge()->icon('heroicon-s-eye')->color('warning')->form([
                    Section::make('LAUNDRY SHOP INFORMATION')->icon('heroicon-s-building-storefront')
                        ->schema([

                            TextInput::make('name')->label('Shop Name'),
                            Textarea::make('description')->label('Shop Description'),
                            TextInput::make('address')->label('Shop Address'),
                            TextInput::make('contact')->label('Phone Number'),
                        ])->columns(2),
                    Section::make('PAYMENTS')->icon('heroicon-s-credit-card')
                        ->schema([
                            ViewField::make('rating')
                                ->view('filament.forms.payments'),
                        ])->columns(2),
                ])->slideOver(),
                Action::make('approve')->badge()->icon('heroicon-s-hand-thumb-up')->color('success'),
                Action::make('reject')->badge()->icon('heroicon-s-hand-thumb-down')->color('danger'),
            ])
            ->bulkActions([
                // ...
            ])->contentGrid([
            'md' => 3,
            'xl' => 4,
        ]);
    }

    public function render()
    {
        return view('livewire.superadmin.shop-list');
    }
}
