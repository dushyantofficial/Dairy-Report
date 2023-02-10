@extends('admin.layouts.app')
@section('content')

    @include('admin.flash-message')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                                           <span class="pull-right float-right"><button type="button"
                                                                                        onclick="printreportData()"
                                                                                        class="btn btn-outline-warning">Print</button>&nbsp;&nbsp;
                 <a class="btn btn-outline-danger"
                    href="{{route('customer-report-pdf')}}?field={{request()}}">
                                Pdf</a>
                    <button type="button" onclick="ExportToExcel('xlsx')" class="btn btn-outline-success">Excel File</button>&nbsp;&nbsp;

                    <a href="{{route('customer-report-show')}}"><button type="button"
                                                                        class="btn btn-outline-dark">Back</button></a>&nbsp</span><br><br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.customer_report_table')</h5>
                            <div class="tile-body" id="my_report">
                                <table id="sampleTable" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>@lang('langs.customer_no')</th>
                                        @if(isset($input['field']['user_id']))
                                            <th> @lang('langs.user_name')</th>
                                        @endif

                                        @if(isset($input['field']['customer_name']))
                                            <th> @lang('langs.customer_name')</th>

                                        @endif

                                        @if(isset($input['field']['bank_name']))
                                            <th> @lang('langs.bank_name')</th>

                                        @endif

                                        @if(isset($input['field']['account_number']))
                                            <th> @lang('langs.account_number')</th>

                                        @endif
                                        @if(isset($input['field']['ifsc_code']))
                                            <th> @lang('langs.ifsc_code')</th>

                                        @endif
                                        @if(isset($input['field']['final_amount']))
                                            <th> @lang('langs.final_amount')</th>

                                        @endif
                                        @if(isset($input['field']['created_by']))
                                            <th> @lang('langs.created_by')</th>

                                        @endif


                                        @if(isset($input['field']['created_at']))
                                            <th> @lang('langs.created_at')</th>

                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>

                                            @if(isset($input['field']['user_id']))
                                                <td>{{$customer->user->user_name}} </td>
                                            @endif
                                            @if(isset($input['field']['customer_name']))
                                                <td>{{$customer->customer_name}} </td>
                                            @endif
                                            @if(isset($input['field']['bank_name']))
                                                <td>{{$customer->bank_name}} </td>
                                            @endif
                                            @if(isset($input['field']['account_number']))
                                                <td>{{$customer->account_number}} </td>
                                            @endif
                                            @if(isset($input['field']['ifsc_code']))
                                                <td>{{$customer->ifsc_code}} </td>
                                            @endif
                                            @if(isset($input['field']['final_amount']))
                                                <td>{{$customer->final_amount}} </td>
                                            @endif
                                            @if(isset($input['field']['created_by']))
                                                <td>{{$customer->created_bys->user_name}} </td>
                                            @endif

                                            @if(isset($input['field']['created_at']))
                                                <td>{{$customer->created_at}} </td>
                                            @endif

                                        </tr>
                                    @endforeach
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
