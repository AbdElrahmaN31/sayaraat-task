<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DepartmentRequest;
use App\Models\Department;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Interfaces\IUserRepository as IManagerRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{

    public function __construct(IDepartmentRepository $departmentRepository,
                                IManagerRepository    $managerRepository)
    {
        $this->middleware('auth');
        $this->departmentRepository = $departmentRepository;
        $this->managerRepository = $managerRepository;
    }

    public function index(Request $request)
    {
        $departments = Department::select('departments.*')
                                 ->selectRaw('COUNT(users.id) as employee_count')
                                 ->selectRaw('SUM(users.salary) as employee_salaries')
                                 ->leftJoin('users', 'departments.id', '=', 'users.department_id')
                                 ->groupBy('departments.id')->get();


        if (request()->ajax()) {
            return DataTables::of($departments)
                             ->addColumn('name', function ($q) {
                                 return $q->name;
                             })
                             ->addColumn('action', function ($q) {
                                 if (auth()->user()?->role === 'admin') {
                                     return '
                                <a href="' . route('departments.edit', $q->id) . '" class="mr-2 btn btn-outline-info btn-sm">
                                    <i class="far fa-edit fa-2x"></i>
                                </a>
                                <a data-href="' . route('departments.destroy', $q->id) . '" data-id="' . $q->id . '" class="mr-2 btn btn-outline-danger btn-delete btn-sm">
                                    <i class="far fa-trash-alt fa-2x"></i>
                                </a>
                            ';
                                 }

                                 return '
                                <a href="#" class="mr-2 btn btn-outline-info btn-sm">
                                    <i class="far fa-edit fa-2x"></i>
                                </a>
                            ';
                             })
                             ->rawColumns([
                                 'name',
                                 'employees_count',
                                 'employees_salaries',
                                 'action',
                             ])
                             ->make(true);
        }

        return view('departments.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return RedirectResponse
     */
    public function store(DepartmentRequest $request)
    {
        $this->departmentRepository->create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function create()
    {
        $managers = $this->managerRepository->getWhere(['role' => 'manager']);
        return view('departments.create', compact('managers'));
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function edit(Department $department)
    {
        $managers = $this->managerRepository->getWhere(['role' => 'manager']);
        return view('departments.edit', compact('department', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $this->departmentRepository->update($department->id, $request->validated());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department)
    {
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments.index')->with('error', 'Department has employees, cannot delete');
        }
        $this->departmentRepository->delete($department->id);
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }
}
