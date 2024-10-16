<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $fillable = ['name', 'entity_type_id', 'user_id'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'entity_attribute', 'entity_id', 'attribute_id')
            ->withPivot('value');
    }
    public function entityType()
    {
        return $this->belongsTo(EntityType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
