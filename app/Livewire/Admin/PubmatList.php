<?php

namespace App\Livewire\Admin;

use App\Models\ShopPubmat;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\ViewColumn;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;

class PubmatList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $file_path = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('file_path')
                    ->label('Upload Pubmat')
                    ->required()
            ]);
    }

    public function savePubmat()
    {
        foreach ($this->file_path as $key => $value) {
            $file = encrypt($value->store('pubmat', 'public'));
            ShopPubmat::create([
                'shop_id' => auth()->user()->shop->id,
                'file_path' => $file,
            ]);
        }
        $this->reset('file_path');
        sweetalert()->success('Pubmat uploaded successfully.');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ShopPubmat::query()->where('shop_id', auth()->user()->shop->id))
            ->columns([
                Grid::make(1)->schema([
                    ViewColumn::make('status')->view('filament.tables.pubmat')
                ])
            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->contentGrid([
                    'md' => 2,
                    'xl' => 3,
                ]);
    }

    public function render()
    {
        return view('livewire.admin.pubmat-list');
    }
}
