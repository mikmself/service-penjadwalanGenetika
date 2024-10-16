<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name'];

    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'entity_attribute', 'attribute_id', 'entity_id')
            ->withPivot('value');
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
