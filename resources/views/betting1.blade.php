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
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>
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

        .dtr-control {
            font-size: 22px;
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
    <style>
        .toggle-button {
            cursor: pointer;
            background-color: transparent;
            border: none;
            outline: none;
            font-size: 0.5em;
        }

        .toggle-icon {
            font-size: 2.2em;
            margin-right: 5px;
        }

        .toggle-button:hover .toggle-icon {
            color: blue; /* Change color on hover */
        }

        .collapsed .toggle-icon::after {
            content: '+';
        }

        /* CSS to style the loader */
        .loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            z-index: 9999;
        }

        .loader-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        font-size: 20px;
        color: #333; /* Adjust text color */
        }
    </style>
@endpush

@section('page-content')
<div class="container mt-4">
    <div class="loader" id="loader">
    <div class="loader-content">
        <!-- You can customize the loader's appearance here -->
        <span>Loading...</span>
    </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between">
                <div class="col col-3 mb-3 text-center">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a class="text-secondary" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ol>
                </div>
                <div class="col col-9 mb-3">
                    <form class="row" action="/betting" method="get">
                        <div class="row">
                            <div class="form-group row col-6">
                                <label for="datepicker" class="col-sm-2 col-form-label">From:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="date" class="form-control datepicker" id="datepicker" required>
                                    <input type="hidden" id="stake" value="4" />
                                </div>
                            </div>
                            <div class="form-group row col-6">
                                <label for="datepicker" class="col-sm-2 col-form-label">To:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="to" class="form-control datepicker" id="to" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-5">
                            <div class="form-group row col-10" style="align-items: center">
                                <label for="datepicker" class="col-sm-2 col-form-label">Odds:</label>
                                <input type="text" name="odd_start" class="form-control d-none" value="{{ $odd_start }}" id="odd_start" required>
                                <input type="text" name="odd_end" class="form-control d-none" value="{{ $odd_end }}" id="odd_end" required>
                                <label class="form-label d-none value" >Odds: </b></label>
                                <div class="col-sm-10" id="nouislider_basic_example"></div>
                            </div>
                            <div class="col col-2" style="align-items: center">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <h4 id='total_range'>Total range: </h4>
                            <label class="form-label d-none value"></label>
                        </div>
                    </div>

                    <div class="container mt-4">
                        @foreach($racing as $key => $race)
                            <div class="mb-4">
                                <h2>
                                    <button class="toggle-button btn btn-link" data-bs-toggle="collapse" data-bs-target="#venue_{{ $key }}" aria-expanded="false" aria-controls="venue_{{ $key }}">
                                        <span id="toggle_icon_{{ $key }}" class="toggle-icon">+</span> {{ $race['venue'] }} - <small style="color: blue">{{ $race['date'] }}</small>
                                    </button>
                                </h2>
                                <div class="collapse" id="venue_{{ $key }}">
                                    <h4 class="total_race" id="{{$race['id']}}"> Total range: {{ $race['sum'] }} </h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            @foreach(range(1, 12) as $keyz)
                                                @php 
                                                    $data =  explode('/', trim($race['import_url'], '/'));
                                                    $venue = isset($data[1]) ? $data[1] : null;
                                                @endphp
                                                <tr class="odd Race" data-race-id="{{ $keyz }}" data-race-date="{{ $race['date'] }}" data-race-venue="{{ $venue }}" id="Race_{{ $keyz }}_{{ str_replace([' ', '(', ')', "'"], ['_', '_', '_', '_'], $race['venue']) }}{{ $race['date'] }}">
                                                    <td class="dtr-control">Race {{ $keyz }}</td>
                                                </tr>
                                                <tr id="Race{{ $keyz }}_{{ str_replace([' ', '(', ')', "'"], ['_', '_', '_', '_'], $race['venue']) }}{{ $race['date'] }}" class="table align-middle mb-0 card-table" cellspacing="0" style="display:none">
                                                    <td>
                                                        <table id="Races{{ $keyz }}_{{ str_replace([' ', '(', ')', "'"], ['_', '_', '_', '_'], $race['venue']) }}{{ $race['date'] }}" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>DOG NAME</th>
                                                                    <th class="text-center">Stake (Units)</th>
                                                                    <th class="text-center">Odds</th>
                                                                    <th class="text-center">Result</th>
                                                                    <th class="text-center">P/L</th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                                                                    <td class="text-center"><strong id="total"></strong></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/nouislider.bundle.js') }}"></script>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const odd_start = urlParams.get('odd_start') ?? 4;
    const odd_end = urlParams.get('odd_end') ?? 100;
    var stakeVal = $('#stake').val();
    var sliderBasic = document.getElementById('nouislider_basic_example');
    noUiSlider.create(sliderBasic, {
      start: [odd_start, odd_end],
      connect: true,
      tooltips: true,
      step: 1,
      range: {
        'min': [0],
        'max': [100]
      }
    });
    getNoUISliderValue(sliderBasic, true);
    //Get noUISlider Value and write on
    function getNoUISliderValue(slider, percentage) {
      slider.noUiSlider.on('update', function() {
        var val = slider.noUiSlider.get();
        var val_start = 0;
        var val_end = 0;
        if (percentage) {
            val_start = parseInt(val[0]);
            val_end = parseInt(val[1]);
        }
        $(slider).parent().find('label.form-label.value').text(val_start + " - " + val_end);
        $('#odd_start').val(val_start);
        $('#odd_end').val(val_end);
      });

      slider.noUiSlider.on('change', function () {
        var val = slider.noUiSlider.get();
        var race_id = localStorage.getItem('race_id'); 
        $("tr.Race").each(function(index, element) {
            let id = $(element).attr("id");

        });
      });
    }
</script>
<script>
        $(document).ready(function() {
            @if($date)
                $('#datepicker').val(moment('{{ $date }}', 'YYYY-MM-DD').format('YYYY-MM-DD'));
                $('#to').val(moment('{{ $to }}', 'YYYY-MM-DD').format('YYYY-MM-DD'));
            @else
                $('#datepicker').val(moment().format('YYYY-MM-DD'));
                $('#to').val(moment().format('YYYY-MM-DD'));
            @endif
            var table = null;
            $("tr.Race").click(function() {
                let id = $(this).attr("id");
                let raceID = $(this).attr('data-race-id');
                let venue = $(this).attr("data-race-venue");
                let dateRace = $(this).attr("data-race-date");
                let nouislider = $('label.form-label.value').html().split(' - ');
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
                                url: '{{ route('betting.datatables') }}',
                                data: function(d) {
                                    d.odd_start = nouislider[0] ?? 0,
                                    d.odd_end = nouislider[1]?? 100,
                                    d.venue = venue,
                                    d.raceID = raceID,
                                    d.date_code = dateRace,
                                    d.dogs = '',
                                    d.distance = 'multi',
                                    d.datepicker = 'all',
                                    d.unique_dog = 'on',
                                    d.time_order = 'ASC',
                                    d.time_ratio = '',
                                    d.plc = ''
                                }
                            },
                            columns: [
                                {
                                    data: 'dog_name',
                                    name: 'dog_name'
                                },
                                {
                                    data: 'stake',
                                    name: 'stake',
                                    searchable: false,
                                    orderable: false
                                },
                                {
                                    data: 'odds',
                                    name: 'odds',
                                    searchable: false,
                                    orderable: false
                                },
                                {
                                    data: 'result',
                                    name: 'result',
                                    searchable: false,
                                    orderable: false
                                },
                                {
                                    data: 'profit_loss',
                                    name: 'profit_loss',
                                    searchable: false,
                                    orderable: false
                                },
                            ],
                            language: {
                                processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                            }
                        });

                }

            });
        });
        setTimeout(() => {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const odd_start = urlParams.get('odd_start') ?? 4;
            const odd_end = urlParams.get('odd_end') ?? 100;
            const date = urlParams.get('date');
            const to = urlParams.get('to');
//            $.ajax({
//                url: '{{ route('betting.total_range') }}',
  //              type: "GET",
    //            async: true,
      //          data: {
        //            odd_start: odd_start,
          //          odd_end: odd_end,
            //        date: date,
              //      to: to,
                //},
               // success: function (data) {
                 //   $('#total_range').html('Total race: ' + data.sum_range);
                   // $('.total_race').each(function(index, element) {
                     //   let id = $(element).attr("id");
                       // let race = data.racing.find((item) => item.id == id);
                       // if (race) {
                        //    $(element).html('Total race: ' + race.sum);
                       // }
                   // });
//                }
//            })
$.ajax({
                url: '{{ route('betting.total_range') }}',
                type: "GET",
                async: true,
                data: {
                    odd_start: odd_start,
                    odd_end: odd_end,
                    date: date,
                    to: to,
                },
                success: function (data) {
                    $('#total_range').html('Total race: ' + data.sum_range);
                    $('.total_race').each(function(index, element) {
                        let id = $(element).attr("id");
                        let race = data.racing.find((item) => item.id == id);
                        if (race) {
                            $(element).html('Total race: ' + race.sum);
                        }
                    });
                }
            })
        }, 1000);
    </script>
    <script>
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

        $('#to').daterangepicker({
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
            $('#to').val(chosen_date.format('YYYY-MM-DD'));
        });
    </script>
        <script>
        const toggleButtons = document.querySelectorAll('.toggle-button');
        toggleButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                const icon = document.getElementById(`toggle_icon_${index}`);
                icon.textContent = icon.textContent === '+' ? '-' : '+';
            });
        });
    </script>
@endpush
