<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Human extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name' => '',
    ];

    /**
     * Specifies which attributes should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Exclude attributes that should not be exposed.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'humans_pets');
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
