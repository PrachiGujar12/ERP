<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OnlineCustomers extends Authenticatable
{
    use HasFactory, Notifiable;
    public $table = 'online-customers';
    public $primaryKey = 'online_customer_id';

    
}
