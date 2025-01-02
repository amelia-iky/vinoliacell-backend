<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public $incrementing = false; // Disable auto incrementing
    protected $keyType = 'string'; // Set primary key type
    protected $table = 'orders'; // Table name
    protected $fillable = ['brand', 'model', 'issue', 'detail', 'status']; // Fillable fields

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

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
