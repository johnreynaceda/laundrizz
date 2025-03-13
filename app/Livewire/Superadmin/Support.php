<?php

namespace App\Livewire\Superadmin;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Support extends Component implements HasForms
{
    use InteractsWithForms;

    public $contact, $website, $email;

    public function mount()
    {
        $data = \App\Models\Support::first();
        if ($data) {
            $this->contact = $data->contact;
            $this->website = $data->website;
            $this->email = $data->email;
        }

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('contact')->suffixIcon('heroicon-s-phone')->numeric()
                    ->required(),
                TextInput::make('website')->suffixIcon('heroicon-s-globe-alt')
                    ->required(),
                TextInput::make('email')->suffixIcon('heroicon-s-envelope')
                    ->required(),

            ]);
    }

    public function save()
    {
        $this->validate();
        \App\Models\Support::updateOrCreate([], [
            'contact' => $this->contact,
            'website' => $this->website,
            'email' => $this->email,
        ]);
        // $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.superadmin.support');
    }
}
