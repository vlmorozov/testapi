<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientToken extends Model
{
    protected $table = 'client_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'client_id', 'token', 'expired_at'
    ];

}
