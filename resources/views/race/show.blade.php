@extends('layouts.app')

@section('page-title', __('Racing & Result'))

@push('stylesheets')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css"
        integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .time_ratio, .plc {
            cursor: pointer;
        }
    </style>
@endpush

@section('page-toolbar')
    <div class="row mb-3 align-items-center">
        <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
            </ol>
        </div>
    </div>
    <!-- .row end -->
@endsection

@section('page-content')
    <div class="col-12">
        <div class="d-flex justify-content-between">
            
            <div class="col col-4 mb-3">
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

            <div class="col col-4 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-2 col-form-label">Dogs:</label>
                    <input type="hidden" id="allDogs" />
                    <div class="col-sm-10">
                        <select class="js-example-basic-multiple" id="dog" name="dogs[]" multiple="multiple">
                            @foreach ($dogs->unique() as $dog)
                                <option value="{{ $dog->dog_id }}">{{ $dog->dog_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- <div class="col col-3 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-2 col-form-label">Order:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="order">
                            <option value="DESC">DESC</option>
                            <option value="ASC">ASC</option>
                        </select>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="d-flex justify-content-between">
            <div class="col col-4 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-2 col-form-label">Date:</label>
                    <div class="col-sm-10">
                        <div class="form-control-scroll">
                            <div id="reportrange"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="datepicker" />
                </div>
            </div>
            <div class="col col-4 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-4 col-form-label">Sort By Time:</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="time_order">
                            <option value="ASC">ASC</option>
                            <option value="DESC">DESC</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col col-1 mb-3">
                <div class="form-check">
                    <input type="checkbox" id="toggleSelect" class="form-check-input" style="width: 1.5em; height: 1.5em; margin-right: 5px; vertical-align: middle;">
                    <label class="form-check-label" for="toggleSelect" style="font-size: 1.5em; vertical-align: middle;">Fastest</label>
                </div>
                <input type="hidden" value="off" id="unique_dog" />
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table_list" class="table align-middle mb-0 card-table" cellspacing="0">
                    <thead>
                        <tr>
			        <th>{{ __('Dog Name') }}</th>
                            <th>{{ __('Sex') }}</th>
                            <th class="plc">
                                <input type="hidden" id="plc" value="" />
                                <i class="fa fa-sort" style="display:none" aria-hidden="true"></i> {{ __('PLC') }}
                            </th>
                            <th>{{ __('BOX') }}</th>
                            <th>{{ __('WGT') }}</th>
                            <th>{{ __('DIST') }}</th>
                            <th>{{ __('DATE') }}</th>
                            <th>{{ __('TRACK') }}</th>
                            <th>{{ __('G') }}</th>
                            <th>{{ __('TIME') }}</th>
                            <th>WIN</th>
                            <th>BON</th>
                            <th class="time_ratio">
                                <input type="hidden" id="time_ratio" value="" />
                                <i class="fa fa-sort" style="display:none" aria-hidden="true"></i> Time Ratio
                            </th>
                            <th>Latest</th>
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
                    lengthMenu: [
                        [10, 25, 50, 100, 500, 1000, -1],
                        [10, 25, 50, 100, 500, 1000, 'All']
                    ],
                    pageLength: 25,
                    responsive: true,
                    ordering: false,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{url('form-racing-list')}}',
                        data: function(d) {
                            d.dogs = $('#allDogs').val(),
                            d.orderA = $('#order').val(),
                            d.distance = $('#distance').val(),
                            d.datepicker = $('#datepicker').val(),
                            d.unique_dog = $('#unique_dog').val(),
                            d.time_order = $('#time_order').val(),
                            d.time_ratio = $('#time_ratio').val(),
                            d.plc = $('#plc').val()
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
                            data: 'time_ratio',
                            name: 'time_ratio',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'latest',
                            name: 'latest',
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
    <script>
        $(document).ready(function() {
            // Parse the URL query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const dateVal = urlParams.get('date');

            // Set the value of the input field
            if (dateVal) {
                $('#datepicker').val(moment(dateVal).format('DD-MM-YYYY'));
            } else {
                $('#datepicker').val(moment().format('DD-MM-YYYY'));
            }
        });

        $('#datepicker').on('apply.daterangepicker', function() {
            var oTable = $('#table_list').dataTable();
            oTable.fnDraw(false);
        });

        $(function() {
            var start = moment('2000-10-11');
            var end = moment('2000-10-11');

            function cb(start, end) {
                switch (start.format('YYYY')) {
                    case '2000':
                        $('#datepicker').val('all');
                        $('#reportrange span').html('All Race');
                        break;

                    default:
                        $('#datepicker').val(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
                        $('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
                        break;
                }
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'All Race': [moment('2000-10-11'), moment('2000-10-11')],
                    'Today': [moment().startOf('day'), moment().endOf('day')],
                    'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days')
                        .endOf('day')
                    ],
                    'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                    'Last 30 Days': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
                    'Last 90 Days': [moment().subtract(89, 'days').startOf('day'), moment().endOf('day')],
		    'Last 180 Days': [moment().subtract(179, 'days').startOf('day'), moment().endOf('day')],
		    'Last 360 Days': [moment().subtract(359, 'days').startOf('day'), moment().endOf('day')],
		    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        });

        $('#reportrange').on('apply.daterangepicker', function() {
            var oTable = $('#table_list').dataTable();
            oTable.fnDraw(false);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            $('#dog').on('select2:select select2:unselect', function(e) {
                $('#allDogs').val($(this).val());
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });

            $('#order').on('change', function() {
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });

            $('#distance').on('change', function() {
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });

            $('#time_order').on('change', function() {
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });

            $('#toggleSelect').on('change', function() {
                if (this.checked) {
                    $('#unique_dog').val("on");
                } else {
                    $('#unique_dog').val("off");
                }
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.plc').on('click', function() {
                var icon = $(this).find('i');
                icon.show();
                if (icon.hasClass('fa-sort')) {
                    icon.removeClass('fa-sort').addClass('fa-sort-amount-asc');
                    $('#plc').val('ASC');
                } else if (icon.hasClass('fa-sort-amount-asc')) {
                    icon.removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc');
                    $('#plc').val('DESC');
                } else {
                    icon.removeClass('fa-sort-amount-desc').addClass('fa-sort');
                    $('#plc').val('')
                    icon.hide();
                }
                $('#time_ratio').val('')
                $('.time_ratio').find('i').removeClass('fa-sort-amount-desc').removeClass('fa-sort-amount-desc').removeClass('fa-sort-amount-asc')
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });

            $('.time_ratio').on('click', function() {
                var icon = $(this).find('i');
                icon.show();
                if (icon.hasClass('fa-sort')) {
                    icon.removeClass('fa-sort').addClass('fa-sort-amount-asc');
                    $('#time_ratio').val('ASC');
                } else if (icon.hasClass('fa-sort-amount-asc')) {
                    icon.removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc');
                    $('#time_ratio').val('DESC');
                } else {
                    icon.removeClass('fa-sort-amount-desc').addClass('fa-sort');
                    $('#time_ratio').val('')
                    icon.hide();
                }
                $('#plc').val('')
                $('.plc').find('i').removeClass('fa-sort-amount-desc').removeClass('fa-sort-amount-desc').removeClass('fa-sort-amount-asc');
                var oTable = $('#table_list').dataTable();
                oTable.fnDraw(false);
            });
        });
    </script>
@endpush
