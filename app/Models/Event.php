<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    /**
     * Get admin that owns the event.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'by_admin_id');
    }

    /**
     * Get event files.
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * The users that belong to the event.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('registered_date', 'earned')
            ->withTimestamps();
    }
}
