@extends('layouts.backend.app')
@push('header')
<link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endpush
@section('content')
    <div id="right-panel" class="right-panel">
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Device</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li>
                                <a href="#" class="active">Devices Table</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())

                        @foreach ($errors->all() as $error)
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <span class="badge badge-pill badge-danger">Erorr</span> {{$error}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endforeach

                        @endif

                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Device Table</strong>
                                <button type="button" class="btn btn-primary mb-1" data-toggle="modal"
                                data-target="#createModal">
                                <i class="fa fa-plus"></i>
                            </button>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Api-key</th>
                                            <th>Data Type</th>
                                            <th>Created_At</th>
                                            <th>Updated_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $key => $device)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$device->name}}</td>
                                            <td>{{$device->api_key}}</td>
                                            <td>6</td>
                                            <td>{{$device->created_at}}</td>
                                            <td>{{$device->updated_at}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary mb-1" data-toggle="modal"
                                                    data-target="#viewModal-{{$device->id}}">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <button type="button" class="btn btn-secondary mb-1" data-toggle="modal"
                                                    data-target="#editModal-{{$device->id}}">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger mb-1" data-toggle="modal"
                                                    data-target="#deleteModal-{{$device->id}}">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .animated -->
            <div class="animated">
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                data-backdrop="static" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Create Device</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.device.store')}}" method="post" id="createForm" class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="name" class=" form-control-label">Name</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="name" name="name" placeholder="Text" class="form-control">
                                        <small class="form-text text-muted">Enter Device name</small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-md" onclick="event.preventDefault();
                                document.getElementById('createForm').submit();">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
               @foreach ($devices as $device)
               <div class="modal fade" id="viewModal-{{$device->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                data-backdrop="static" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">View</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{$device->name}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Api-Key</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{$device->api_key}}</p>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Created At</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{$device->created_at}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Updated At</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{$device->updated_at}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editModal-{{$device->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                data-backdrop="static" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Create Device</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.device.update', $device->id)}}" method="post" id="updateForm-{{$device->id}}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="name" class=" form-control-label">Name</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="device-name" name="name" placeholder="Text" class="form-control" value="{{$device->name}}">
                                        <small class="form-text text-muted">Enter Device name</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="api_key" class=" form-control-label">Api Key</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="api_key" name="api_key" placeholder="Text" class="form-control" value="{{$device->api_key}}">
                                        <small class="form-text text-muted">generate api keys</small>
                                        <span><button type="button" id="apikeygen" class="btn btn-success" onclick="document.getElementById('api_key').value=generateUUID()">Generate</button></span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-md" onclick="event.preventDefault();
                                document.getElementById('updateForm-{{$device->id}}').submit();">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal-{{$device->id}}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
                data-backdrop="static" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticModalLabel">Delete Device</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                The device will be deleted !!
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('deletedevice-{{$device->id}}').submit();">Confirm</button>
                    <form action="{{route('admin.device.destroy', $device->id)}}" style="display: none" id="deletedevice-{{$device->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                        </div>
                    </div>
                </div>
            </div>
               @endforeach


                <!-- .content -->
            </div>


<!-- .content -->
@endsection

@push('footer')

<script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('backend/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('backend/assets/js/init-scripts/data-table/datatables-init.js')}}">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
    <script>
        $(document).ready(function () {

            (function ($) {

                $('#filter').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.searchable tr').hide();
                    $('.searchable tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
        ////////////////////////////////////////////////////////////////////////////////////////////////
        // Generate random api-keys
        /**
            * Function to produce UUID.
            * See: http://stackoverflow.com/a/8809472
            */
            function generateUUID()
            {
                var d = new Date().getTime();

                if( window.performance && typeof window.performance.now === "function" )
                {
                    d += performance.now();
                }

                var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c)
                {
                    var r = (d + Math.random()*16)%16 | 0;
                    d = Math.floor(d/16);
                    return (c=='x' ? r : (r&0x3|0x8)).toString(16);
                });

            return uuid;
            }

    </script>

@endpush
