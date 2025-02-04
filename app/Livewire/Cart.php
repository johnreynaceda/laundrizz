<?php

namespace App\Livewire;

use App\Models\Subscription;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;
use Livewire\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;

class Cart extends Component implements HasForms
{
    use InteractsWithForms;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('LAUNDRY SHOP INFORMATION')
                ->description('Please input the required fields.')
                ->schema([
                        FileUpload::make('image')->label('Shop Image'),
                    ViewField::make('rating')
                        ->view('filament.forms.empty'),
                    TextInput::make('name')->label('Shop Name'),
                    TextInput::make('description')->label('Shop Description'),
                    TextInput::make('address')->label('Shop Address'),
                    TextInput::make('phone_number')->label('Phone Number'),
                ])->columns(2),
                Section::make('PAYMENT')
                ->description('Please upload the payment information')
                ->schema([
                        FileUpload::make('image')->label('Shop Image'),
                    ViewField::make('rating')
                        ->view('filament.forms.empty'),
                    TextInput::make('reference_number')->label('Reference Number')->numeric(),
                    
                ])->columns(2),
            ]);
    }
    
    public function render()
    {
        return view('livewire.cart',[
            'subscriptions' => Subscription::get(),
        ]);
    }
}
