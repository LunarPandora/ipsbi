<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $primaryKey = "id_komentar";

    protected $fillable = [
        'id_post',
        'isi_komentar',
        'nama',
        'email',
    ];

    public function posts(): BelongsTo{
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}
