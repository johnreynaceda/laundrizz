<?php

namespace App\Livewire\Auth;

use App\Notifications\OtpNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginUser extends Component
{
    public $email, $password;

    public $one, $two, $three, $four;

    public $otp_modal = false;

    public $attempt;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    


    public function render()
    {
        return view('livewire.auth.login-user');
    }

    public function login(){
        sleep(1);

        $this->validate();

        if (Auth::validate(['email' => $this->email, 'password' => $this->password])) {
            $this->attempt = Auth::getLastAttempted();

        if ($this->attempt->user_type != 'superadmin' && $this->attempt->user_type != 'admin') {
           $otp =  str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
           $this->attempt->update([
            'requested_otp' => $otp,
           ]);
           $this->attempt->notify(new OtpNotification($otp));
            $this->otp_modal = true;
        } else {
            Auth::login($this->attempt);
            return redirect()->route('dashboard');
        }
        } else {
            session()->flash('error', 'Invalid credentials. Please try again.');
        }
    }

    

    public function verifyLogin(){
       sleep(2);
        $otpInput = $this->one . $this->two . $this->three . $this->four;
    
        
       
    
        $user = $this->attempt;
        if ($user->requested_otp == $otpInput) {
            // Clear OTP after successful login
            $user->update(['requested_otp' => null]);
    
            // Log the user in
            Auth::login($user);
    
            // Redirect to the dashboard
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Invalid OTP. Please try again.');
        }
    
    }
}
