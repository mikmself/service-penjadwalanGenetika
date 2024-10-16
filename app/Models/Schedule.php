<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'start_time', 'end_time'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke entities (sebagai virtual tabel yang dimiliki oleh schedule ini)
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}

