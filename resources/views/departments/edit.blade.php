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
                                        href="{{route('departments.index')}}">{{__('dash.departments')}}</a>
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
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6" style="min-height: 500px;">
                    <div class="col-md-12 text-left mb-3">
                        <h3>{{ __('dash.edit') }}</h3>
                    </div>
                    <div class="col-md-12">
                        <form action="{{ route('departments.update', $department->id) }}" method="post" class="form-horizontal"
                              enctype="multipart/form-data" id="create_product_form" data-parsley-validate="">
                            @method('PUT')
                            @csrf
                            <div class="box-body">
                                <h4 class="text-primary">Main Data</h4>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="title">{{ __('dashboard.name') }}</label>
                                        <input type="text" name="name" class="form-control" id="title"
                                               placeholder="Enter Department Name"
                                               value="{{ $department->name }}" required>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="manager_id">{{ __('dash.manager') }}</label>
                                        <select id="manager_id" class="form-control"
                                                style="width: 100%; padding: 8px"
                                                name="manager_id">
                                            @foreach($managers as $manager)
                                                <option value="{{$manager->id}}" {{ $department->manager_id === $manager->id ? 'selected' : '' }}>
                                                    {{ $manager->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('manager_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
