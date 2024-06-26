@extends('layout.layout')

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
                                        href="{{route('dashboard.home')}}">{{__('dash.home')}}</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{__('dash.tasks')}}</li>
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

        <div class="layout-top-spacing">

            <div class="col-xl-11 col-lg-11 col-sm-11 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-md-12 text-right mb-3">
                        @if(in_array(auth()->user()?->role, ['admin', 'manger']))
                            <a href="{{route('tasks.create')}}" id="" class="btn btn-primary card-tools">
                                {{__('dash.add_new')}}
                            </a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="html5-extension" class="table table-hover non-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('dash.title')}}</th>
                                <th>{{__('dash.employee')}}</th>
                                <th>{{__('dash.status')}}</th>
                                <th>{{__('dash.due_date')}}</th>
                                <th>{{__('dash.actions')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>

        </div>

    </div>
@endsection

@push('script')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#html5-extension').DataTable({
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-clinic'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-clinic mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-clinic'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                order: [[0, 'desc']],
                "language": {
                    "url": "{{app()->getLocale() == 'ar'? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                },
                processing: true,
                responsive: true,
                serverSide: false,
                ajax: '{{ route('tasks.index') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'Title'},
                    {data: 'employee_name', name: 'Employee'},
                    {data: 'status', name: 'Status'},
                    {data: 'due_date', name: 'Due Date'},
                    {
                        data: 'action', name: 'action'
                    },
                ]
            });
        });
    </script>

@endpush
