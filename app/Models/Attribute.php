<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = ['entity_id', 'name', 'data_type'];
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class); // AttributeValue milik satu Attribute
    }
}
