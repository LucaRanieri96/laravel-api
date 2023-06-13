<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type_id'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
