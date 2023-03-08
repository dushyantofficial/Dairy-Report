
@extends('admin.layouts.app')
@section('content')
    <style>
        .modal {
            --bs-modal-width: 1041px;
        }

    </style>
    @include('admin.flash-message')
{{--    @dd(request()->check)--}}
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                {{--                Payment Report Filter--}}
                <div class="col-lg-12">
                    <div class="card " id="divMsg" style="display:none">
                        <div class="card-body table-responsive" id="sampleTable">
                            <center><h5 class="card-title">@lang('langs.payment_register_report')</h5></center>
                            <div class="tile-body" id="my_report">
                                <form id="myform" action="{{route('payment-register-report')}}" method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@lang('langs.fields'):</label>
                                        </div>


                                        <div class="col-md-3">
                                            <label for="customer_name"> @lang('langs.from_customer_code') </label>
                                            <input type="number" id="customer_name" name="customer_from_code"
                                                   class="form-control" value="{{request()->customer_from_code}}"
                                                   required>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="bank_name"> @lang('langs.to_customer_code')</label>
                                            <input type="number" class="form-control" id="bank_name"
                                                   name="customer_to_code"
                                                   value="{{request()->customer_to_code}}" required>

                                        </div>
                                        <span style="color: red;margin-left: 342px;">{{$errors->first('field')}}</span>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@lang('langs.select_date'):</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input id="reportrange" name="date"
                                                   @if(request('date') != 'null') value="{{request('date')}}"
                                                   @endif class="pull-left form-control daterange"
                                                   style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@lang('langs.bank_name'):</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select
                                                class="form-control @error('bank_name') is-invalid @enderror"
                                                name="bank_name" id="customer_id">
                                                <option value="">---@lang('langs.bank_name')---</option>
                                                @foreach($bank_names as $bank_name)
                                                    <option
                                                        value="{{$bank_name->bank_name}}" {{ request()->bank_name == $bank_name->bank_name ? 'selected' : '' }}>{{$bank_name->bank_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@lang('langs.account_number'):</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="customer_name" name="check"
                                                   onclick="onlyOne(this)" value="account_number" @if (request()->check == 'account_number') checked @endif>
                                            <label for="account_number"> @lang('langs.account_number') </label><br>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="without_account_number" name="check"
                                                   onclick="onlyOne(this)"
                                                   class="check_all" value="without_account_number" @if (request()->check == 'without_account_number') checked @endif>
                                            <label
                                                for="customer_name"> @lang('langs.without_account_number') </label><br>
                                        </div>
                                    </div>
                                    <br>

                                    <center>
                                        <button type="button" class="btn btn-outline-secondary"
                                                onClick="showHideDiv('divMsg')" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-outline-primary">Filter</button>

                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Payment Report Filter End--}}
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-success"
                                    id="payment_report" onClick="showHideDiv('divMsg')">Filter
                            </button>
                            </span>
                            <a href="{{route('payment-register-report')}}" class="btn btn-outline-dark ml-3">Reset</a>

                            <a class="btn btn-outline-danger"
                               href="{{route('payment-register-report-pdf')}}?date={{request()->date}}&
                               customer_from_code={{request()->customer_from_code}}&
                               customer_to_code={{request()->customer_to_code}}&
                                check={{request()->check}}">
                                Pdf </a>

                            <button type="button" class="btn btn-outline-info"
                                    data-bs-toggle="modal" data-bs-target="#verticalycentered">Setup
                            </button>&nbsp;&nbsp;

                            <button type="button" class="btn btn-outline-primary"
                                    onclick="ExportToExcel('xlsx')">Excel
                            </button>

                            <a class="btn btn-outline-warning" id="Pairings_by_Table_call"
                               href="#">
                                Print </a>
                        </div>
                        </form>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.payment_register_report')</h5>
                            <div class="tile-body" id="my_report">
                                <table id="sampleTable" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('langs.customer_no')</th>
                                        <th scope="col">@lang('langs.customer_name')</th>
                                        <th scope="col">@lang('langs.customer_code')</th>
                                        <th scope="col">@lang('langs.mobile_number')</th>
                                        <th scope="col">@lang('langs.bank_name')</th>
                                        @if(request()->check == 'account_number' || request()->check == null)
                                        <th scope="col">@lang('langs.account_number')</th>
                                        @endif
                                        <th scope="col">@lang('langs.ifsc_code')</th>
                                        <th scope="col">@lang('langs.final_amount')</th>
                                        <th scope="col">@lang('langs.created_at')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($filter_payment_register))
                                        @foreach($filter_payment_register as $customer)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$customer->customer_name}}</td>
                                                <td>{{$customer->customer_code}}</td>
                                                <td>{{$customer->user->mobile_number}}</td>
                                                <td>{{$customer->bank_name}}</td>
                                                @if(request()->check == 'account_number' || request()->check == null)
                                                <td>{{$customer->account_number}}</td>
                                                @endif
                                                <td>{{$customer->ifsc_code}}</td>
                                                <td>{{get_rupee_currency($customer->final_amount)}}</td>
                                                <td>{{$customer->created_at}}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $user = \Illuminate\Support\Facades\Auth::user();
            ?>
            <div id="table_print">
                <input type="hidden" id="mandali_address" value="{{$user->mandali_address}}">
                <input type="hidden" id="mandali_code" value="{{$user->mandali_code}}">
                <table class="table" id="pri_table" style="display: none">
                    <thead>
                    <tr>
                        <th scope="col">@lang('langs.customer_no')</th>
                        <th scope="col">@lang('langs.customer_name')</th>
                        <th scope="col">@lang('langs.customer_code')</th>
                        <th scope="col">@lang('langs.mobile_number')</th>
                        <th scope="col">@lang('langs.bank_name')</th>
                        @if(request()->check == 'account_number' || request()->check == null)
                        <th scope="col">@lang('langs.account_number')</th>
                        @endif
                        <th scope="col">@lang('langs.ifsc_code')</th>
                        <th scope="col">@lang('langs.final_amount')</th>
                        <th scope="col">@lang('langs.created_at')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($filter_payment_register))
                        @foreach($filter_payment_register as $customer)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_code}}</td>
                                <td>{{$customer->user->mobile_number}}</td>
                                <td>{{$customer->bank_name}}</td>
                                @if(request()->check == 'account_number' || request()->check == null)
                                <td>{{$customer->account_number}}</td>
                                @endif
                                <td>{{$customer->ifsc_code}}</td>
                                <td>{{$customer->final_amount}}</td>
                                <td>{{$customer->created_at}}</td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

{{--                Setup Filter--}}

                <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('langs.customer_report_table')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="myform" action="{{route('customer_report_export')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>@lang('langs.select_date'):</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="reportrange" name="date"
                                               @if(request('date') != 'null') value="{{request('date')}}"
                                               @endif class="pull-left form-control daterange"
                                               style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>@lang('langs.check_all'):</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox"
                                               id="checkall">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>@lang('langs.fields'):</label>
                                    </div>


                                    <div class="col-md-2">
                                        <input type="checkbox" id="customer_name" name="field[customer_name]"
                                               class="check_all" value="customer_name">
                                        <label for="customer_name"> @lang('langs.customer_name') </label><br>
                                        <input type="checkbox" id="final_amount" name="field[final_amount]"
                                               class="check_all" value="final_amount">
                                        <label for="admission_number"> @lang('langs.final_amount')</label><br>
                                        <input type="checkbox" id="created_by" name="field[created_by]"
                                               class="check_all" value="created_by">
                                        <label for="admission_number"> @lang('langs.created_by')</label><br>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="checkbox" class="check_all" id="bank_name" name="field[bank_name]"
                                               value="bank_name">
                                        <label for="bank_name"> @lang('langs.bank_name')</label><br>
                                        <input type="checkbox" class="check_all" id="created_at"
                                               name="field[created_at]"
                                               value="created_at">
                                        <label for="dob">@lang('langs.created_at')</label><br>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="check_all" id="account_number"
                                               name="field[account_number]"
                                               value="account_number">
                                        <label for="account_number"> @lang('langs.account_number')</label><br>
                                        <input type="checkbox" class="check_all" id="account_number"
                                               name="field[user_id]"
                                               value="user_id">
                                        <label for="user_id"> @lang('langs.user_name')</label><br>
                                    </div>
                                    <span style="color: red;margin-left: 342px;">{{$errors->first('field')}}</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div><!-- End Vertically centered Modal-->

        </section>
    </main>

@endsection
@push('page_scripts')

    <script>
        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('check')
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }
    </script>
    <script type="text/javascript">
        function showHideDiv(ele) {
            var srcElement = document.getElementById(ele);
            if (srcElement != null) {
                if (srcElement.style.display == "block") {
                    srcElement.style.display = 'none';
                } else {
                    srcElement.style.display = 'block';
                }
                return false;
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
    <script>
        $('#checkall').change(function () {
            $('.check_all').prop('checked', this.checked);
        });

        $('.check_all').change(function () {
            if ($('.check_all:checked').length == $('.check_all').length) {
                $('#checkall').prop('checked', true);
            } else {
                $('#checkall').prop('checked', false);
            }
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("#Pairings_by_Table_call").click(function () {

                $('#pri_table').show();
                var mandali_address = $('#mandali_address').val();
                var mandali_code = $('#mandali_code').val();
                var date = $('#reportrange').val();

                var contents = $("#table_print").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({"position": "absolute", "top": "-1000000px"});
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.

                frameDoc.document.write('<html><head><title> </title><center>' + mandali_address + '-' + mandali_code + '<center>Bank Payment Statement<br><center>Date:' + date + '');
                frameDoc.document.write('</head><body>');
                //Append the external CSS file.
                // frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
                $('#pri_table').attr("style", "display:none");
            });
        });

        $(function () {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('.daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('.daterange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
    </script>


    @php
        $user = request()->user_id;
        if (isset($user)){
        $user_report = \App\Models\User::findOrfail($user);
        }
    @endphp

    <script>

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('my_report')
            var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"});
            return dl ?
                XLSX.write(wb, {bookType: type, bookSST: true, type: 'base64'}) :
                @if(\Illuminate\Support\Facades\Auth::user()->role == config('constants.ROLE.ADMIN'))
                XLSX.writeFile(wb, fn || ('<?php if (isset($user_report)) {
                    echo $user_report->name;
                } ?>_Reports.' + (type || 'xlsx')));
            @else
            XLSX.writeFile(wb, fn || ('<?php if (isset(Auth::user()->name)) {
                echo Auth::user()->name;
            } ?>_Reports.' + (type || 'xlsx')));
            @endif
        }

    </script>

@endpush
