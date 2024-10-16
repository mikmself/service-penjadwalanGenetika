<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'entity_type_id', 'user_id'];

    // Relasi ke EntityType
    public function entityType()
    {
        return $this->belongsTo(EntityType::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke AttributeValue
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
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
