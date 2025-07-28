<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'credit_hours'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
