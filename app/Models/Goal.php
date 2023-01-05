<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'about', 'user_id', 'days',];

    public function getUsers()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
