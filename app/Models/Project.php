<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'cover_image', 'repoUrl', 'startingDate', 'type_id', 'user_id'];

    
    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }
    
    public static function generateRepoUrl($slug) {
        $repoUrl = 'https://github.com/LucaRanieri96/' . $slug;
        return $repoUrl;
    }
    
    public function type(): BelongsTo 
    {
        return $this->BelongsTo(Type::class);
    }

    public function technologies(): BelongsToMany 
    {
        return $this->BelongsToMany(Technology::class);
    }

    /**
     * Get the user that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
