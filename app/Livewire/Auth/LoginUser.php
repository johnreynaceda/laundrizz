<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginUser extends Component
{
    public $email, $password;

    public $otp_modal = false;

    public $attempt;

    protected $rules = [
        'email' => 'required',
        'password' => 'required|min:6',
    ];

    public function render()
    {
        return view('livewire.auth.login-user');
    }

    public function login()
    {
        sleep(1);

        $this->validate();

        $fieldType = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::validate([$fieldType => $this->email, 'password' => $this->password])) {
            $this->attempt = Auth::getLastAttempted();

            // Direct login without OTP validation
            Auth::login($this->attempt);

            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Invalid credentials. Please try again.');
        }
    }
}
