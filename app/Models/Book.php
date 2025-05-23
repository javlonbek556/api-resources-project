<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable =[
        'title',
        'description',
        'price',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
