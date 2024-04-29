@extends('layout.layout')
@push('style')
    <style>
        #imagePreview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .previewImage {
            position: relative;
            margin: 5px;
            max-width: 100px;
            max-height: 100px;
        }

        .previewImage img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .removeImage {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 3px 6px;
            border-radius: 50%;
            font-weight: bold;
            font-size: 12px;
        }

        #fileInput {
            display: none;
        }

        #addImageButton {
            background-color: rgba(255, 67, 1);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #addImageButton:hover {
            background-color: rgba(255, 67, 1, 0.83);
        }
    </style>
@endpush
@section('sub-header')
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 py-2">
                                <li class="breadcrumb-item"><a
                                        href="{{route('home')}}">{{__('dash.home')}}</a></li>

                                <li class="breadcrumb-item"><a
                                        href="{{route('departments.index')}}">{{__('dash.tasks')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('dash.edit')}}</li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </header>
    </div>
@endsection
@php
    $isEmployee = auth()->user()->role == 'employee';
@endphp
@if(!$isEmployee)
    @section('content')
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-6" style="min-height: 500px;">
                        <div class="col-md-12 text-left mb-3">
                            <h3>{{ __('dash.create') }}</h3>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('tasks.store') }}" method="post" class="form-horizontal"
                                  enctype="multipart/form-data" id="create_product_form" data-parsley-validate="">
                                @csrf
                                <div class="box-body">
                                    <h4 class="text-primary">Main Data</h4>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="title">{{ __('dash.title') }}</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                   placeholder="Enter Task Title"
                                                   value="{{ old('title') }}" required>
                                            @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="description">{{ __('dash.task_description') }}</label>
                                            <input type="text" name="description" class="form-control" id="description"
                                                   placeholder="Enter Task description"
                                                   value="{{ old('description')  }}">
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="status">{{ __('dash.status') }}</label>
                                            <select name="status" class="form-control" id="status" required>
                                                <option value="">Select Task Status</option>
                                                <option value="todo" {{ old('status')  == 'todo' ? 'selected' : '' }}>To Do</option>
                                                <option value="in_progress" {{ old('status')  == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                                            </select>
                                            @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="priority">{{ __('dash.priority') }}</label>
                                            <select name="priority" class="form-control" id="priority" required>
                                                <option value="">Select Task priority</option>
                                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                            </select>
                                            @error('priority')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group col-md-4">
                                            <label for="employee_id">{{ __('dash.employee') }}</label>
                                            <select id="employee_id" class="form-control"
                                                    style="width: 100%; padding: 8px"
                                                    name="employee_id" required>
                                                @foreach($employees as $employee)
                                                    <option
                                                        value="{{$employee->id}}" {{ old('employee_id') === $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="start_date">{{ __('dash.start_date') }}</label>
                                        <input type="date" name="start_date" class="form-control" id="start_date"
                                               value="{{ old('start_date') }}" required>
                                        @error('start_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="due_date">{{ __('dash.due_date') }}</label>
                                        <input type="date" name="due_date" class="form-control" id="due_date"
                                               value="{{ old('due_date') }}" required>
                                        @error('due_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="completed_at">{{ __('dash.completed_at') }}</label>
                                        <input type="date" name="completed_at" class="form-control" id="completed_at"
                                               value="{{ old('completed_at') }}">
                                        @error('completed_at')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('dash.save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
