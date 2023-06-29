<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get user files.
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * The events that belong to the user.
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withPivot('registered_date', 'earned')
            ->withTimestamps();
    }

    /**
     * user files in specific event
     */
    public function scopeEventFiles(Builder $query, $event){
        return $this->files()->where('event_id' , $event->id)->get();
    }
}
