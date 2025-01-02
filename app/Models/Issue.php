<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Issue extends Model
{
    public $incrementing = false; // Disable auto incrementing
    protected $keyType = 'string'; // Set primary key type
    protected $table = 'issues'; // Table name
    protected $fillable = [
        'name',
    ]; // Fillable fields

    // Set UUID as primary key
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = substr((string) Str::uuid(), 0, 5);
            }
        });
    }
}
