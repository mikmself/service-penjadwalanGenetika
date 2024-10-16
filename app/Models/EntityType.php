<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    protected $fillable = ['type'];

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}
