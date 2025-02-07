<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = "users";
    protected $primaryKey = "id_user";
    protected $guarded = ['id_user'];

    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
        'foto_profil',
    ];

    public function posts(): HasMany{
        return $this->hasMany(Post::class, 'id_user', 'id_user');
    }
}
