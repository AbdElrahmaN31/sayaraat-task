<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TaskRequest;
use App\Models\Task;
use App\Repositories\Interfaces\ITaskRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function __construct(ITaskRepository $taskRepository,
                                IUserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }


    public function index(Request $request)
    {
        $tasks = Task::join('users', 'tasks.employee_id', '=', 'users.id')
                     ->select('tasks.id', 'tasks.status', 'tasks.title', 'tasks.due_date', 'tasks.employee_id', 'users.first_name', 'users.last_name');


        if (request()->ajax()) {
            return DataTables::of($tasks)
                             ->addColumn('title', function ($q) {
                                 return $q->title;
                             })
                             ->addColumn('employee_name', function ($q) {
                                 return $q->first_name . ' ' . $q->last_name;
                             })
                             ->addColumn('action', function ($q) {
                                 return '
                                <a href="' . route('tasks.edit', $q->id) . '" class="mr-2 btn btn-outline-info btn-sm">
                                    <i class="far fa-edit fa-2x"></i>
                                </a>
                                <a data-href="' . route('tasks.destroy', $q->id) . '" data-id="' . $q->id . '" class="mr-2 btn btn-outline-danger btn-delete btn-sm">
                                    <i class="far fa-trash-alt fa-2x"></i>
                                </a>
                            ';
                             })
                             ->rawColumns([
                                 'title',
                                 'status',
                                 'due_date',
                                 'employee_name',
                                 'action',
                             ])
                             ->make(true);
        }

        return view('tasks.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        $role = user()->role;
        $managerId = $role == 'manager' ? auth()->id() : null;
        $employeesFilter = ['role' => 'employee', 'manager_id' => $managerId, 'id' => $role == 'employee' ? auth()->user()?->id : null];
        $employees = $this->userRepository->getWhere(array_filter($employeesFilter));

        return view('tasks.add', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $this->taskRepository->create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Task $task)
    {
        $employees = $this->userRepository->getWhere(['role' => 'employee', 'manager_id' => auth()->id()]);
        return view('tasks.edit', compact('task', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->taskRepository->update($task->id, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(Task $task)
    {
        if (user()->role != 'admin' && $task->manager_id != user()->id) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized action');
        }

        $this->taskRepository->delete($task->id);
        return response()->json(['message' => 'Task deleted successfully']);
    }

}
