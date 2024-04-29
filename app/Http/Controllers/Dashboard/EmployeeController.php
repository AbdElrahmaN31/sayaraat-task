<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EmployeeRequest;
use App\Models\User;
use App\Models\User as Employee;
use App\Repositories\Interfaces\IUserRepository as IEmployeeRepository;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{

    public function __construct(IEmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index()
    {
        $employees = User::query()
                         ->employees()
                         ->mine()
                         ->leftJoin('users as managers', 'users.manager_id', '=', 'managers.id')
                         ->select(
                             'users.id',
                             'users.first_name',
                             'users.last_name',
                             'users.salary',
                             'users.image',
                             'managers.first_name as manager_first_name',
                             'managers.last_name as manager_last_name'
                         )->get();

        if (request()->ajax()) {
            return DataTables::of($employees)
                             ->addColumn('employee_full_name', function ($q) {
                                 return $q->first_name . ' ' . $q->last_name;
                             })->addColumn('manager_full_name', function ($q) {
                    return $q->manager_first_name . ' ' . $q->manager_last_name;
                })->addColumn('image', function ($q) {
                    return '<img src="' . $q->image . '" class="img-thumbnail" width="100" height="100" />';
                })
                             ->addColumn('action', function ($q) {
                                 return '
                                <a href="' . route('employees.edit', $q->id) . '" class="mr-2 btn btn-outline-info btn-sm">
                                    <i class="far fa-edit fa-2x"></i>
                                </a>
                                <a data-href="' . route('employees.destroy', $q->id) . '" data-id="' . $q->id . '" class="mr-2 btn btn-outline-danger btn-delete btn-sm">
                                    <i class="far fa-trash-alt fa-2x"></i>
                                </a>
                            ';
                             })
                             ->rawColumns([
                                 'first_name',
                                 'last_name',
                                 'salary',
                                 'image',
                                 'employee_full_name',
                                 'manager_full_name',
                                 'action',
                             ])
                             ->make(true);
        }

        return view('employees.index');
    }

    public function store(EmployeeRequest $request)
    {
        $this->employeeRepository->create($request->validated());
        return redirect()->route('employees.index');
    }

    public function create()
    {
        $managers = $this->employeeRepository->getWhere(['role' => 'manager']);
        return view('employees.add', compact('managers'));
    }

    public function edit(Employee $employee)
    {
        $managers = $this->employeeRepository->getWhere(['role' => 'manager']);
        return view('employees.edit', compact('employee', 'managers'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $department)
    {
        //
    }
}
