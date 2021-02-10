<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Profiles;

class Avatar extends Model
{
    protected $table = 'avatar';
    protected $primaryKey = 'avatar_id';

    public function profile()
    {
    	return $this->belongsTo(Profiles::class, 'profile_id', 'profile_id');
    }
}



