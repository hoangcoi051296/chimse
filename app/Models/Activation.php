<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $table = 'activations';
    protected $fillable = ['type','user_id','token','is_active'];

    public function createToken($user)
    {
        return $this->create([
            'type' => $user->type,
            'user_id' => $user->id,
            'token' => bin2hex(random_bytes(12)),
            'is_active' => 0
        ]);
    }
}
