<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'start_time', 'end_time'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

}

