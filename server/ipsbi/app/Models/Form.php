<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = "form";
    protected $primaryKey = "id_form";

    protected $fillable = [
        'id_user',
        'title',
        'desc',
        'link',
        'foto_form'
    ];
}
