<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

use App\Models\Profiles;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    public $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'password',
        'user_type_id',
        'ip_address',
        'created_by',
        'dt_created',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];


    public $timestamps = false;


    public function profile()
    {
        return $this->hasOne(Profiles::class, 'user_id', 'user_id');
    }

    public static function signInByRequest($request)
    {   
        try {
            $users = self::where([
                    ['username', $request->username]
                    //['password', DB::raw("AES_ENCRYPT('".$request->password."','D0xch3ckT3l3m3d1c1n3')")]
                ])->first();
            

            if ($users) { 

                if(Auth::loginUsingId($users->user_id)){ 

                    $user = Auth::user(); 
                    $tokenResult = $user->createToken('Personal Access Token 1');
                    $token = $tokenResult->token;
                    if($user->remember_token) $token->expires_at = date('d-m-Y', strtotime("+1 week"));
                    $token->save();        
                    $user->ip_address = $request->ipAddress;        
                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();

                    return [
                        'success'               => true, 
                        'user_id'               => $user->user_id,
                        'profile_id'            => $user->profile->profile_id,
                        'name'                  => substr($user->profile->firstname, 0, 1).' '.$user->profile->lastname,
                        'token_type'            => 'Bearer',
                        'token'                 => $token,
                        'access_token'          => $tokenResult->accessToken,
                        'avatar'                => $user->profile->avatar ? json_decode($user->profile->avatar->meta)->thumb[0]->path.$user->profile->avatar->filename : '/assets/images/default.png'
                    ];
                }
                else{ 
                    return ['success' => false, 'message' => 'Unauthorised, auth is not valid.'];
                } 
            } 
            else{ 
                return ['success' => false, 'message' => 'Unauthorised, the email or password you entered is incorrect.'];
            } 
        } catch (Throwable $e) {

            return  $e->getMessage();
        }
    }

    public static function signOut()
    {   
        try {
            Auth::logout();

            return true;
        } catch (Exception $e) {

            return $e->getMessage();
        }   
    }
}
