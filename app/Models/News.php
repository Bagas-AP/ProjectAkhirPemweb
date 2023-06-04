<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class News extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'category',
        'image'
    ];

    protected $casts = [
        'image' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
