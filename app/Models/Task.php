<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'employee_id',
        'manager_id',
        'department_id',
        'priority',
        'start_date',
        'due_date',
        'completed_at'
    ];

    protected $casts = [
        'start_date'   => 'datetime:Y-m-d',
        'due_date'     => 'datetime:Y-m-d',
        'completed_at' => 'datetime:Y-m-d',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('mine', function ($builder) {
            $user = auth()->user();
            $builder->when($user?->isEmployee(), function ($query) use ($user) {
                return $query->where('tasks.employee_id', $user->id);
            })->when($user?->isManager(), function ($query) use ($user) {
                return $query->where('tasks.manager_id', $user->id);
            });
            return $builder;
        });
    }

    /**
     * Get the employee that owns the task.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Get the manager that owns the task.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the department that owns the task.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getIsCompletedAttribute(): bool
    {
        return $this->status === 'done';
    }

    public function scopeDone()
    {
        return $this->where('status', 'done');
    }

    public function scopeInProgress()
    {
        return $this->where('status', 'in_progress');
    }

    public function scopeTodo()
    {
        return $this->where('status', 'todo');
    }

    public function scopeHighPriority()
    {
        return $this->where('priority', 'high');
    }

    public function scopeMediumPriority()
    {
        return $this->where('priority', 'medium');
    }

    public function scopeLowPriority()
    {
        return $this->where('priority', 'low');
    }

}
