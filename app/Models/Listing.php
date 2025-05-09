<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * This defines which fields can be automatically filled
     * when using methods like Model::create() or Model::update().
     *
     * For security, Laravel protects models against the mass assignment
     * of unauthorized fields. Only the attributes listed here
     * can be assigned in bulk operations.
     *
     * Example usage:
     * Model::create([
     *     'name' => 'João',
     *     'email' => 'joao@email.com'
     * ]);
     */
    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
        'price'
    ];
}
