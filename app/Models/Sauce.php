<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sauce extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'name',
        'manufacturer',
        'description',
        'mainPepper',
        'imageUrl',
        'heat',
        'likes',
        'dislikes',
        'usersLiked',
        'usersDisliked'
  ];

  protected $casts = [
    'usersLiked' => 'array',
    'usersDisliked' => 'array'
];

    public function user() {
        return $this->belongsTo('App\Models\User', 'userId'); // Clé étrangère : userId
    }
}
