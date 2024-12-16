<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plugin extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'slug']; // Incluye 'slug' en fillable si usas el tercer método

    // Mutator para el campo 'slug'
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value ?? $this->attributes['name']);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
