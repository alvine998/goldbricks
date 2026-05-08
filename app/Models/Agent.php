<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'facebook',
        'twitter',
        'linkedin',
        'pinterest',
        'whatsapp',
        'sort_order',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->orderBy('agent_project.sort_order');
    }
}
