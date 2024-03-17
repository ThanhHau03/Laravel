<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

//    protected $appends = [
//        'year_created_at',
//    ];

//    những cột không được phép điền
//    protected $guarded = [];

    public function getYearCreatedAtAttribute()
    {
        return $this->created_at->format('Y');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
        // có nhiều sinh viên
    }
}
