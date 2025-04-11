<?php

namespace App\Livewire\Auth;

use App\Models\CustomerProfile;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class RegisterUser extends Component implements HasForms
{
    use InteractsWithForms;
    public $type;

    public $name, $email, $password, $confirm_password, $identification = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([


                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required(),
                TextInput::make('confirm_password')->password()->same('password')->required(),
                FileUpload::make('identification')->required()->visible(fn($record) => $this->type == 'Customer')
                    ->label('Identification')
                    ->helperText('Upload a valid identification'),

            ]);
    }

    public function register()
    {
        sleep(2);
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'username' => strtolower(str_replace(' ', '_', $this->name)),
            'password' => bcrypt($this->password),
            'user_type' => $this->type == 'Merchant' ? 'admin' : 'customer',
            // 'is_approved' => $this->type != 'Merchant' ? true : false
        ]);

        if ($this->type == 'Customer') {
            foreach ($this->identification as $key => $value) {
                CustomerProfile::create([
                    'user_id' => $user->id,
                    'identification_path' => $value->store('identifications', 'public'),
                ]);
            }
        }

        event(new Registered($user));

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register-user');
    }
}
