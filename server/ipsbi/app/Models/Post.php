<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $primaryKey = "id_post";

    protected $fillable = [
        'judul',
        'url_isi',
        'foto_post',
        'id_user',
        'id_kategori',
        'tag',
    ];

    public function comments(): HasMany{
        return $this->hasMany(Comment::class, 'id_post', 'id_post');
    }

    public function category(): HasOne{
        return $this->hasOne(Category::class, 'id_kategori', 'id_kategori');
    }

    public function owner(): BelongsTo{
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
