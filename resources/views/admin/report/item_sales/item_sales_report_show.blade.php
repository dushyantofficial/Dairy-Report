@extends('admin.layouts.app')
@section('content')
    @include('admin.flash-message')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-3">
                            <form action="{{ route('item-sales-report-show') }}" method="GET"
                                  enctype="multipart/form-data">
                                <input id="reportrange" name="date"
                                       @if(request('date') != 'null') value="{{request('date')}}"
                                       @endif class="pull-left form-control daterange"
                                       style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        </div>

                        <div class="col-6">
                            <button class="btn btn-outline-success">Filter</button>
                            </span>
                            <a href="{{route('item-sales-report-show')}}" class="btn btn-outline-dark ml-3">Reset</a>

                            <a class="btn btn-outline-danger"
                               href="{{route('item-sales-report-pdf')}}?date={{request()->date}}">
                                Pdf </a>


                            <button type="button" class="btn btn-outline-info"
                                    data-bs-toggle="modal" data-bs-target="#verticalycentered">Setup
                            </button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-outline-primary"
                                    onclick="ExportToExcel('xlsx')">Excel
                            </button>
                            <a href="{{route('item-sales-report-show')}}"
                               class="btn btn-outline-warning ml-3">Print</a>

                        </div>
                        </form>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.item_sales_report_table')</h5>
                            <div class="tile-body" id="my_report">
                                <table id="sampleTable" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('langs.item_sales_no')</th>
                                        <th scope="col">@lang('langs.customer_name')</th>
                                        <th scope="col">@lang('langs.item_name')</th>
                                        <th scope="col">@lang('langs.itemQuantity')</th>
                                        <th scope="col">@lang('langs.payment_from_date')</th>
                                        <th scope="col">@lang('langs.payment_to_date')</th>
                                        <th scope="col">@lang('langs.from_morning_evening')</th>
                                        <th scope="col">@lang('langs.to_morning_evening')</th>
                                        <th scope="col">@lang('langs.deduct_from_date')</th>
                                        <th scope="col">@lang('langs.deduct_to_date')</th>
                                        <th scope="col">@lang('langs.entry_date')</th>
                                        <th scope="col">@lang('langs.deduct_morning_evening')</th>
                                        <th scope="col">@lang('langs.payment')</th>
                                        <th scope="col">@lang('langs.deduct_payment')</th>
                                        <th scope="col">@lang('langs.total')</th>
                                        {{--                                    <th scope="col">@lang('langs.item_sales_action')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($filter_item_sales))
                                        @foreach($filter_item_sales as $item_sales)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$item_sales->customers->customer_name}}</td>
                                                <td>{{$item_sales->item_names->item_name->item_name}}</td>
                                                <td>{{$item_sales->item_quantity}}</td>
                                                <td>{{$item_sales->payment_from_date}}</td>
                                                <td>{{$item_sales->payment_to_date}}</td>
                                                <td>{{$item_sales->from_morning_evening}}</td>
                                                <td>{{$item_sales->to_morning_evening}}</td>
                                                <td>{{$item_sales->deduct_from_date}}</td>
                                                <td>{{$item_sales->deduct_to_date}}</td>
                                                <td>{{$item_sales->entry_date}}</td>
                                                <td>{{$item_sales->deduct_morning_evening}}</td>
                                                <td>{{$item_sales->payment}}</td>
                                                <td>{{$item_sales->deduct_payment}}</td>
                                                <td>{{$item_sales->total}}</td>

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
            <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('langs.item_purchase_report_table')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="myform" action="{{route('item_purchase_report_export')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Select Date:</label>
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
                                        <label>Check All:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox"
                                               id="checkall" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Fields:</label>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="checkbox" id="item_name_id"  class="check_all" name="field[item_name_id]"
                                               value="item_name_id">
                                        <label for="customer_name"> @lang('langs.item_name') </label><br>
                                        <input type="checkbox" id="Sales_Rates"  class="check_all" name="field[Sales_Rates]"
                                               value="Sales_Rates">
                                        <label for="Sales_Rates"> @lang('langs.Sales_Rates')</label><br>
                                        <input type="checkbox" id="purchase_date"  class="check_all" name="field[purchase_date]"
                                               value="purchase_date">
                                        <label for="Sales_Rates"> @lang('langs.purchase_date')</label><br>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" id="item_quantity"  class="check_all" name="field[item_quantity]"
                                               value="item_sales_id">
                                        <label for="bank_name"> @lang('langs.itemQuantity')</label><br>
                                        <input type="checkbox" id="created_at"  class="check_all" name="field[created_at]"
                                               value="created_at">
                                        <label for="dob">@lang('langs.created_at') </label><br>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" id="Purchase_Rate"  class="check_all" name="field[Purchase_Rate]"
                                               value="Purchase_Rate">
                                        <label for="Purchase_Rate"> @lang('langs.Purchase_Rate')</label><br>
                                        <input type="checkbox" id="created_by" class="check_all" name="field[created_by]"
                                               value="created_by">
                                        <label for="created_by"> @lang('langs.created_by')</label><br>
                                    </div>
                                    <span style="color: red;margin-left: 161px;">{{$errors->first('field')}}</span>
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
                </div><!-- End Vertically centered Modal-->


        </section>
    </main>

@endsection
@push('page_scripts')

    <script>
        $('#checkall').change(function () {
            $('.check_all').prop('checked',this.checked);
        });

        $('.check_all').change(function () {
            if ($('.check_all:checked').length == $('.check_all').length){
                $('#checkall').prop('checked',true);
            }
            else {
                $('#checkall').prop('checked',false);
            }
        });
    </script>
    <script type="text/javascript">
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
