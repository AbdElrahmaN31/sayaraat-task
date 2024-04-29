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

    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .form-container form {
            display: grid;
            grid-gap: 20px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #0056b3;
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
    $isEmployee = auth()->user()?->role == 'employee';
    $isAdmin = auth()->user()?->role == 'admin';
    $isManager = auth()->user()?->role == 'manager';
    $currentUserId = auth()->user()?->id;
    $currentUserDepartmentId = auth()->user()?->department_id;
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
                            <form action="{{ route('employees.store') }}" method="post" class="form-horizontal"
                                  enctype="multipart/form-data" id="create_product_form" data-parsley-validate="">
                                @csrf
                                <div class="box-body">
                                    <h4 class="text-primary">Main Data</h4>
                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label for="image">{{ __('dash.image') }}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                            @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div id="imagePreview"></div>
                                            <button type="button" id="cancelImage" style="display: none;">Cancel</button>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label for="first_name">{{ __('dash.first_name') }}</label>
                                            <input type="text" name="first_name" class="form-control" id="first_name"
                                                   placeholder="Enter first name"
                                                   value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="last_name">{{ __('dash.last_name') }}</label>
                                            <input type="text" name="last_name" class="form-control" id="last_name"
                                                   placeholder="Enter last name"
                                                   value="{{ old('first_name') }}" required>
                                            @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="email">{{ __('dash.email') }}</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                   placeholder="Enter email"
                                                   value="{{ old('email')  }}">
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="phone">{{ __('dash.phone') }}</label>
                                            <input type="tel" name="phone" class="form-control" id="phone"
                                                   placeholder="Enter phone"
                                                   pattern="(\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})"
                                                   title="Saudi Arabia mobile numbers start with '+9665', '05' or '5' followed by an 8-digit number."
                                                   value="{{ old('phone')  }}" required>
                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="password">{{ __('dash.password') }}</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                   placeholder="Enter password"
                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,16}"
                                                   title="Must contain at least one number and one uppercase and lowercase letter, one special character, and at least 8 to 16 characters."
                                                   value="{{ old('password')  }}" required>
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if($isAdmin)
                                            <div class="form-group col-md-12">
                                                <label for="role">{{ __('dash.role') }}</label>
                                                <select name="role" class="form-control" id="role" required>
                                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                                </select>
                                                @error('role')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @else
                                            <input type="hidden" name="role" value="employee">
                                        @endif

                                        @if($isAdmin)
                                            <div class="form-group col-md-12">
                                                <label for="manager_id">{{ __('dash.manager') }}</label>
                                                <select id="manager_select" name="manager_id" class="form-control" id="manager_id" required>
                                                    @foreach($managers as $manager)
                                                        <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                                                            {{ $manager->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('manager_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <input type="hidden" id="hidden_manager_id" name="manager_id" value="{{ $currentUserId }}">
                                            <input type="hidden" id="department_id" name="department_id" value="{{ old('department_id') }}">
                                        @else
                                            <input type="hidden" name="manager_id" value="{{ $currentUserId }}">
                                            <input type="hidden" name="department_id" value="{{ $currentUserDepartmentId }}">
                                        @endif

                                        <div class="form-group col-md-12">
                                            <label for="salary">{{ __('dash.salary') }}</label>
                                            <input type="number" name="salary" class="form-control" id="salary"
                                                   placeholder="Enter salary"
                                                   value="{{ old('salary')  }}" required>
                                            @error('salary')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">{{ __('dash.save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script>
            document.getElementById('manager_select').addEventListener('change', function() {
                var selectedManagerId = this.value;
                // Assuming you have the managers data in a JavaScript object
                var selectedManager = managers.find(function(manager) {
                    return manager.id === selectedManagerId;
                });
                if (selectedManager) {
                    document.getElementById('hidden_manager_id').value = selectedManager.id;
                    document.getElementById('department_id').value = selectedManager.department_id;
                }
            });

            document.getElementById('image').addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result + '" width="200">';
                    document.getElementById('cancelImage').style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            });

            document.getElementById('cancelImage').addEventListener('click', function() {
                document.getElementById('image').value = '';
                document.getElementById('imagePreview').innerHTML = '';
                this.style.display = 'none';
            });
        </script>
    @endpush
@endif
