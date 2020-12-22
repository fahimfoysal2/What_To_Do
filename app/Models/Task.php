<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'created',
        'end_time'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
