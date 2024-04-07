<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class warungapiPersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;
    protected $table = 'warungapi_personal_access_tokens';

    protected $fillable = [
        'tokenable',
        'name',
        'token',
        'abilities',
        'last_used_at'
    ];

}
