<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'peminjaman_user_id', 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function register(array $data)
    {
        return self::create($data);
    }

    protected static function upload_profile($id, $data): void
    {
        $user = self::find($id);
        if ($user->user_pict_url) {
            Storage::delete($user->user_pict_url);
        }
        if ($data) {
            $path = $data->store('profile_pictures');
            $user->user_pict_url = $path;
        }
        $user->save();
    }
}
