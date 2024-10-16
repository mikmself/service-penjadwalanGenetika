<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityRelationship extends Model
{
    protected $fillable = ['entity_id_1', 'entity_id_2', 'relationship_type'];

    public function entity1()
    {
        return $this->belongsTo(Entity::class, 'entity_id_1');
    }

    public function entity2()
    {
        return $this->belongsTo(Entity::class, 'entity_id_2');
    }
}
