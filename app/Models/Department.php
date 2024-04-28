<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id'];

    public function employees()
    {
        return $this->hasMany(User::class, 'department_id')->where('role', 'employee');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
