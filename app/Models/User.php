<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Admin;
use App\Models\Supplier;
use App\Models\Customer;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
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

    /* 
    Cek Role
    */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSupplier()
    {
        return $this->role === 'supplier';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    /* 
    Relasi ke Admin, Supplier, Customer
   */
    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'id_user');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'user_id', 'id_user');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'id_user');
    }
}
