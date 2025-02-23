<?php
namespace App\Livewire\Admin;

use App\Models\Staff;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class StaffList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Staff::query()->where('shop_id', auth()->user()->shop->id))->headerActions([
            CreateAction::make('new')->label('New Staff')->icon('heroicon-o-plus-circle')->form([
                Grid::make(2)->schema([
                    TextInput::make('firstname')->required(),
                    TextInput::make('lastname')->required(),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('password')->password()->required(),
                ]),
            ])->action(
                function ($data) {
                    $user = User::create([
                        'name'              => $data['firstname'] . ' ' . $data['lastname'],
                        'email'             => $data['email'],
                        'password'          => bcrypt($data['password']),
                        'email_verified_at' => now(),
                        'is_approved'       => true,
                        'user_type'         => 'staff',
                    ]);
                    Staff::create([
                        'shop_id' => auth()->user()->shop->id,
                        'user_id' => $user->id,
                    ]);
                }
            )->modalWidth('xl'),
        ])->columns([
            TextColumn::make('user.name')->label('NAME')->searchable(),
            TextColumn::make('user.email')->label('EMAIL')->searchable(),

        ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.staff-list');
    }
}
