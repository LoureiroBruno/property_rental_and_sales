<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Normalize the name: capitalize the first letter of each word.
     * Example: 'francisco jossé ferreira da costa' => 'Francisco Jossé Ferreira Da Costa'
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => ucwords(strtolower($value))
        );
    }

    /**
     * Automatically normalize email to lowercase before saving to database.
     * Ensures consistency and avoids duplicate emails with different cases.
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtolower($value)
        );
    }

    public function listings(): HasMany
    {
        return $this->hasMany(
            Listing::class,
            'by_user_id'
        );
    }

    public function offers(): HasMany
    {
        return $this->hasMany(
            Offer::class,
            'bidder_id'
        );
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
