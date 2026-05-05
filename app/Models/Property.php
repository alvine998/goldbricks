<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $table = 'properties';
    protected $fillable = ['project_id', 'title', 'slug', 'description', 'type', 'price', 'location', 'status', 'image', 'images', 'sort_order'];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getTypeLabel()
    {
        return [
            'house' => 'Rumah',
            'apartment' => 'Apartemen',
            'ruko' => 'Ruko',
            'kavling' => 'Kavling',
            'other' => 'Lainnya',
        ][$this->type] ?? $this->type;
    }

    public function getStatusLabel()
    {
        return [
            'available' => 'Tersedia',
            'sold' => 'Terjual',
            'reserved' => 'Dipesan',
        ][$this->status] ?? $this->status;
    }
}
