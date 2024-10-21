<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityRelationship extends Model
{
    use HasFactory;
    protected $fillable = ['parent_entity_id', 'child_entity_id', 'relationship_type'];
    public function parentEntity()
    {
        return $this->belongsTo(Entity::class, 'parent_entity_id');
    }
    public function childEntity()
    {
        return $this->belongsTo(Entity::class, 'child_entity_id');
    }
}

