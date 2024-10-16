<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relasi ke entities
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}
