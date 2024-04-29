<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return in_array(auth()->user()?->role, ['admin', 'manager']);
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
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'email'         => 'required|string|email|max:255|unique:users,email',
                'phone'         => 'required|unique:users,phone',
                'password'      => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                'role'          => 'required|string|max:80|in:employee',
                'manager_id'    => 'required|exists:users,id,role,manager',
                'department_id' => 'required|exists:departments,id',
                'salary'        => 'required|numeric|min:0',
                'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } else {
            return [
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'email'         => 'required|string|email|max:255|unique:users,email,' . $this->employee?->id,
                'phone'         => 'required|unique:users,phone,' . $this->employee?->id,
                'password'      => ['nullable', 'string', 'min:8', 'regex:regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                'role'          => 'required|string|max:80|in:employee',
                'manager_id'    => 'required|exists:users,id,role,manager',
                'department_id' => 'required|exists:departments,id',
                'salary'        => 'required|numeric|min:0|max:99999999.99',
                'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
