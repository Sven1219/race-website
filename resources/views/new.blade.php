@extends('layouts.app')

@section('page-title', __('Racing & Result'))

@push('stylesheets')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css"
        integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css"
        integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .mdshow {
            display: none !important;
        }

        @media only screen and (max-width: 768px) {
            .mdhide {
                display: none !important;
            }

            .mdshow {
                display: block !important;
            }
        }

        .content {
            display: none;
            padding: 10px;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
            transition: max-height 0.3s ease-in-out;
        }

        /* .dtr-control {
                cursor: pointer;
            } */
    </style>
@endpush

@section('page-content')
    <div class="col-8 m-auto">
        <div class="d-flex justify-content-between">
            <div class="col col-3 mb-3 text-center">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a class="text-secondary" href="{{ url('/') }}">{{ __('Home') }}</a>
                    </li>
                </ol>
            </div>
            <div class="col col-6 mb-3 text-center">
                <h3>{{ $venue_display }} <span style="font-size:20px" id="date">( {{ $date }} )</span></h3>
            </div>
            <div class="col col-3 mb-3">
                <div class="form-group row">
                    <label for="datepicker" class="col-sm-2 col-form-label">Date:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control datepicker" id="datepicker">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table_list" class="table align-middle mb-0 card-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd Race" id="Race_1">
                            <td class="dtr-control">Race 1</td>
                        </tr>
                        <tr id="Race1" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="even Race" id="Race_2">
                            <td class="dtr-control">Race 2</td>
                        </tr>
                        <tr id="Race2" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="odd Race" id="Race_3">
                            <td class="dtr-control">Race 3</td>
                        </tr>
                        <tr id="Race3" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="even Race" id="Race_4">
                            <td class="dtr-control">Race 4</td>
                        </tr>
                        <tr id="Race4" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races4" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="odd Race" id="Race_5">
                            <td class="dtr-control">Race 5</td>
                        </tr>
                        <tr id="Race5" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races5" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="even Race" id="Race_6">
                            <td class="dtr-control">Race 6</td>
                        </tr>
                        <tr id="Race6" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races6" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="odd Race" id="Race_7">
                            <td class="dtr-contro">Race 7</td>
                        </tr>
                        <tr id="Race7" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                            <td>
                                <table id="Races7" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="even Race" id="Race_8">
                            <td class="dtr-control">Race 8</td>
                        </tr>
                        <tr id="Race8" class="table align-middle mb-0 card-table" cellspacing="0"
                            style="display:none">
                            <td>
                                <table id="Races8" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="odd Race" id="Race_9">
                            <td class="dtr-control">Race 9</td>
                        </tr>
                        <tr id="Race9" class="table align-middle mb-0 card-table" cellspacing="0"
                            style="display:none">
                            <td>
                                <table id="Races9" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="even Race" id="Race_10">
                            <td class="dtr-control">Race 10</td>
                        </tr>
                        <tr id="Race10" class="table align-middle mb-0 card-table" cellspacing="0"
                            style="display:none">
                            <td>
                                <table id="Races10" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="odd Race" id="Race_11">
                            <td class="dtr-control">Race 11</td>
                        </tr>
                        <tr id="Race11" class="table align-middle mb-0 card-table" cellspacing="0"
                            style="display:none">
                            <td>
                                <table id="Races11" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr class="even Race" id="Race_12">
                            <td class="dtr-control">Race 12</td>
                        </tr>
                        <tr id="Race12" class="table align-middle mb-0 card-table" cellspacing="0"
                            style="display:none">
                            <td>
                                <table id="Races12" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DOG NAME</th>
                                            <th>SEX</th>
                                            <th>PLC</th>
                                            <th>ROUND</th>
                                            <th>TIME ROUND</th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                    </tbody>

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
            $('#datepicker').val(moment('{{ $date }}', 'YYYY-MM-DD').format('YYYY-MM-DD'));
            var table = null;
            $("tr.Race").click(function() {
                let id = $(this).attr("id");
                var race_id = id.replace("Race_", "");
                localStorage.setItem("race_id", race_id);
                var displayStatus = $('#Race' + race_id).css('display');
                if (displayStatus == 'none') {
                    $('#Race' + race_id).show();
                } else {
                    $('#Race' + race_id).hide();
                    $('#Race' + race_id + "_wrapper").hide();
                }

                if (displayStatus == "none") {
                    if($.fn.dataTable.isDataTable('#Races' + race_id)) table.destroy();

                    table = $('#Races' + race_id)
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
                                url: '{{ url('show_rank_per_race') }}',
                                data: function(d) {
                                        d.venue = '{{ $venue }}',
                                        d.raceID = race_id,
                                        d.date_code = $('#datepicker').val(),
                                        d.dogs = '',
                                        d.distance = 'multi',
                                        d.datepicker = 'all',
                                        d.unique_dog = 'on',
                                        d.time_order = 'ASC',
                                        d.time_ratio = '',
                                        d.plc = ''
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
                            ],
                            language: {
                                processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                            },
                        });

                }

            });

        });
    </script>

    <script>
        $('#datepicker').on('apply.daterangepicker', function() {
            $('#date').text($('#datepicker').val());
            var oTable = $('#Races' + race_id).dataTable();
            oTable.fnDraw(false);
        });

        $('#datepicker').daterangepicker({
            drops: 'down',
            "locale": {
                "format": "MM/DD/YYYY",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "firstDay": 1
            },
            singleDatePicker: true,
            autoApply: true,
            autoUpdateInput: false,
        }, function(chosen_date) {
            $('#datepicker').val(chosen_date.format('YYYY-MM-DD'));
        });
    </script>
@endpush
