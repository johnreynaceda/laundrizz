<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_type',
        'is_approved',
        'requested_otp',
        'email_verified_at',
        'profile_photo',
        'data_privacy',
        'terms_agreement'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function serviceTransactions()
    {
        return $this->hasMany(ServiceTransaction::class);
    }

    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class);
    }

    public function customerProfile()
    {
        return $this->hasOne(CustomerProfile::class);
    }
}
