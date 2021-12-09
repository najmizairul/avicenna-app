<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ["last_visited_at", 'created_at', 'updated_at'];

    public function visits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
       return $this->hasMany(PatientVisit::class);
    }
}
