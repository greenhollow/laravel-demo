<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Human extends Model
{
    use HasFactory;
    use HasUuids; // <-- by default, incremental and targets the `id` column

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name' => '', // <-- non-nullable hidden by factory
        // 'uuid' => Uuid::uuid4(), <-- "Constant expression contains invalid operations"
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
     * Generate a new UUID for the model.
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }
}
