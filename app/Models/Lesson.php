<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    
    public function revervations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    
    public function getVacancyLevelAttribute(): VacancyLevel
    {
        return new VacancyLevel($this->remainingCount());
    }

    private function remainingCount(): int
    {
        return $this->capacity - $this->revervations()->count();
    }
}