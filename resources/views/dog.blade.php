@extends('layouts.app')

@section('page-title', __('Racing & Result'))

@push('stylesheets')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css"
        integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page-toolbar')
    <div class="row mb-3 align-items-center">
        <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a class="text-secondary" href="{{ url('/') }}">{{ __('Racing') }}</a></li>
                <li class="breadcrumb-item"><a class="text-secondary"">{{ ucfirst($dog_name) }}</a></li>
            </ol>
        </div>
    </div>
    <!-- .row end -->
@endsection

@section('page-content')
    <div class="col-12">
        <div class="d-flex justify-content-end">
            <div class="col col-3 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-5 col-form-label">Fastest Time:</label>
                    <div class="col-sm-7">
                        <select class="form-control" id="distance">
                            <option value="">Fastest Time</option>
                            @foreach ($distance as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col col-3 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-2 col-form-label">Order:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="order">
                            <option value="DESC">DESC</option>
                            <option value="ASC">ASC</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table_list" class="table align-middle mb-0 card-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('Dog Name') }}</th>
                            <th>{{ __('Sex') }}</th>
                            <th>{{ __('PLC') }}</th>
                            <th>{{ __('BOX') }}</th>
                            <th>{{ __('WGT') }}</th>
                            <th>{{ __('DIST') }}</th>
                            <th>{{ __('DATE') }}</th>
                            <th>{{ __('TRACK') }}</th>
                            <th>{{ __('G') }}</th>
                            <th>{{ __('TIME') }}</th>
                            <th>WIN</th>
                            <th>BON</th>
                            <th>1 SEC</th>
                            <th>MGN</th>
                            <th>PIR</th>
                            <th>SP</th>
                            <th>ROUND</th>
                            <th>TIME ROUND</th>
                 	    <th>W/2G</th>
			 </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#table_list')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    ordering: false,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: 'https://dogpower.pro/form-racing-list',
                        data: function(d) {
                            d.orderA = $('#order').val(),
                            d.distance = $('#distance').val(),
                        }
                    },
                    columns: [{
                            data: 'dpg_name',
                            name: 'dpg_name'
                        },
                        {
                            data: 'sex',
                            name: 'sex',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'plc',
                            name: 'plc',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'box',
                            name: 'box',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'wgt',
                            name: 'wgt',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'dist',
                            name: 'dist',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'date',
                            name: 'date',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'track',
                            name: 'track',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'G',
                            name: 'G',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'Time',
                            name: 'Time',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'Win',
                            name: 'Win',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'Bon',
                            name: 'Bon',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: '_Sec',
                            name: '_Sec',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'MGN',
                            name: 'MGN',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'PIR',
                            name: 'PIR',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'SP',
                            name: 'SP',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'distance',
                            name: 'distance',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'time2',
                            name: 'time2',
                            searchable: false,
                            orderable: false
                        },
			{
                            data: 'W_2G',
                            name: 'W_2G',
                            searchable: false,
                            orderable: false
                        },
                    ],
                    language: {
                        processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    },
                });
        });
    </script>
@endpush
