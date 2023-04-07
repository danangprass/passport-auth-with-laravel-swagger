<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidates';
    protected $fillable = [
        'name',
        'experience',
        'education',
        'bod',
        'last_position',
        'applied_position',
        'skills',
        'email',
        'phone',
        'resume_url',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $path = str_replace(URL::to('/storage'), 'public', $model->resume_url);
            Storage::delete($path);
        });
    }
}
