<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Avatar;
use App\Models\User;

class Profiles extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'profile_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class, 'profile_id');
    }
}



