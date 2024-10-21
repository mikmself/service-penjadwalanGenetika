<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'schedule_id'];

    public function attributes()
    {
        return $this->hasMany(Attribute::class); // Entity memiliki banyak Attribute
    }
    // Relasi ke AttributeValue
    public function attributeValues()
    {
        return $this->hasManyThrough(AttributeValue::class, Attribute::class); // Entity memiliki banyak AttributeValue melalui Attribute
    }

    // Relasi ke EntityRelationship sebagai parent
    public function parentRelationships()
    {
        return $this->hasMany(EntityRelationship::class, 'parent_entity_id');
    }

    // Relasi ke EntityRelationship sebagai child
    public function childRelationships()
    {
        return $this->hasMany(EntityRelationship::class, 'child_entity_id');
    }

    // relasi ke table schedules
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
