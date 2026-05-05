<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'price',
        'type',
        'status',
        'image',
        'images',
        'featured',
        'sort_order',
        'pic_name',
        'pic_phone',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'images' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
