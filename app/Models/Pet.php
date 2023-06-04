<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Pet extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
    ];

    public function scopeBornThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('date_of_birth', date('m'));
    }

    public function humans()
    {
        return $this->belongsToMany(Human::class, 'humans_pets');
    }

    /**
     * Get the columns that should receive a unique identifier.
     */
    public function uniqueIds(): array
    {
        return [
            'uuid',
        ];
    }

    /**
     * Generate a new UUID for the model, overriding the default incremental
     * UUID type.
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Get the route key for the model, overriding the default targeting of the
     * id column.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
