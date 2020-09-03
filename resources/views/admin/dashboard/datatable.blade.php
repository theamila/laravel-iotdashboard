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
                        <h1>Data Table</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li>
                                <a href="#" class="active">Data Table</a>
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
                                <strong class="card-title">Data Table</strong>
                            </button>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Device</th>
                                            <th>Pm2_5</th>
                                            <th>Pm10</th>
                                            <th>Temperature</th>
                                            <th>Humidity</th>
                                            <th>Pressure</th>
                                            <th>Sea-level</th>
                                            <th>Created_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($iotData as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->device->name}}</td>
                                            <td>{{$data->pm2_5}}</td>
                                            <td>{{$data->pm10}}</td>
                                            <td>{{$data->temp}}</td>
                                            <td>{{$data->hum}}</td>
                                            <td>{{$data->pressure}}</td>
                                            <td>{{$data->sealevel}}</td>
                                            <td>{{$data->created_at}}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger mb-1" data-toggle="modal"
                                                    data-target="#deleteModal-{{$data->id}}">
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
               @foreach ($iotData as $data)
            <div class="modal fade" id="deleteModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
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
                            document.getElementById('deletedata-{{$data->id}}').submit();">Confirm</button>
                    {{--  <form action="{{route('admin.device.destroy', $device->id)}}" style="display: none" id="deletedevice-{{$device->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>  --}}
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
