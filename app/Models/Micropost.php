<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    /** @use HasFactory<\Database\Factories\MicropostFactory> */
    use HasFactory;

    protected $fillable = ['content'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * このポストをお気に入りしているユーザー
     */
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
}
