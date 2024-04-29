<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()?->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'name'       => 'required|string|max:255|unique:departments,name',
                'manager_id' => 'required|exists:users,id,role,manager',
            ];
        } else {
            return [
                'name'       => 'required|string|max:255|unique:departments,name,' . $this->department?->id,
                'manager_id' => 'required|exists:users,id,role,manager',
            ];

        }
    }
}
