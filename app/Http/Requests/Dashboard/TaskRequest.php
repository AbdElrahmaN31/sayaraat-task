<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (in_array(auth()->user()?->role, ['admin', 'manager'])) {
            return [
                'title'         => 'required|string|max:255',
                'description'   => 'nullable|string',
                'start_date'    => 'nullable|date',
                'completed_at'  => 'nullable|date|after:start_date',
                'due_date'      => 'nullable|date',
                'priority'      => 'nullable|in:low,medium,high',
                'status'        => 'nullable|in:todo,in_progress,done',
                'employee_id'   => 'required|exists:users,id,role,employee',
                'manager_id'    => 'required|exists:users,id,role,manager',
                'department_id' => 'required|exists:departments,id',
            ];
        } else {
            return [
                'status'       => 'nullable|string|max:255',
                'start_date'   => 'nullable|date',
                'completed_at' => 'nullable|date|after:start_date',
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (auth()->user()?->isManager()) {
            $this->merge(['manager_id' => auth()->id(), 'department_id' => auth()->user()?->department_id]);
        }
    }
}
