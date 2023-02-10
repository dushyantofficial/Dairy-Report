@extends('admin.layouts.app')
@section('content')

    @include('admin.flash-message')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-3">
                            <form action="{{ route('item-sales-report') }}" method="GET" enctype="multipart/form-data">
                                <input id="reportrange" name="date"
                                       @if(request('date') != 'null') value="{{request('date')}}"
                                       @endif class="pull-left form-control daterange"
                                       style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        </div>
                        <div class="col-6">
                            <button class="btn btn-success">@lang('langs.filter')</button>
                            </span>
                            <a href="{{route('item-sales-report')}}" class="btn btn-dark ml-3">@lang('langs.reset')</a>
                            <a class="btn btn-danger"
                               href="{{route('item-sales-report-pdf')}}?date={{request()->date}}">
                                @lang('langs.pdf_file') </a>
                            <button type="button" class="btn btn-primary"
                                    onclick="ExportToExcel('xlsx')">@lang('langs.excel_file')</button>
                        </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.item_sales_report')</h5>
                            <div class="tile-body" id="my_report">
                                <table id="sampleTable" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('langs.item_sales_no')</th>
                                        <th scope="col">@lang('langs.customer_name')</th>
                                        <th scope="col">@lang('langs.item_name')</th>
                                        <th scope="col">@lang('langs.PayFromDT')</th>
                                        <th scope="col">@lang('langs.PayToDT')</th>
                                        <th scope="col">@lang('langs.Payment_Rate')</th>
                                        <th scope="col">@lang('langs.DeductFromDT')</th>
                                        <th scope="col">@lang('langs.DeductToDT')</th>
                                        <th scope="col">@lang('langs.Deduct_Rate')</th>
                                        <th scope="col">@lang('langs.Total_DT')</th>
                                        <th scope="col">@lang('langs.Total_Rate')</th>
                                        <th scope="col">@lang('langs.itemQuantity')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($filter_item_sales))
                                        @foreach($filter_item_sales as $item_sales)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$item_sales->customers->customer_name}}</td>
                                                <td>{{$item_sales->item_names->item_name}}</td>
                                                <td>{{$item_sales->PayFromDT}}</td>
                                                <td>{{$item_sales->PayToDT}}</td>
                                                <td>{{$item_sales->Payment_Rate}}</td>
                                                <td>{{$item_sales->DeductFromDT}}</td>
                                                <td>{{$item_sales->DeductToDT}}</td>
                                                <td>{{$item_sales->Deduct_Rate}}</td>
                                                <td>{{$item_sales->Total_DT}}</td>
                                                <td>{{$item_sales->Total_Rate}}</td>
                                                <td>{{$item_sales->itemQuantity}}</td>

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
        </section>
    </main>

@endsection
@push('page_scripts')


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

        function pdfreport() {

            html2canvas($('#my_report')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    @if(\Illuminate\Support\Facades\Auth::user()->role == config('constants.ROLE.ADMIN'))
                    pdfMake.createPdf(docDefinition).download('<?php if (isset($user_report)) {
                        echo $user_report->name;
                    } ?>_Reports.pdf');
                    @else
                    pdfMake.createPdf(docDefinition).download('<?php if (isset(Auth::user()->name)) {
                        echo Auth::user()->name;
                    } ?>_Reports.pdf');
                    @endif
                }
            });

        }

    </script>

@endpush
