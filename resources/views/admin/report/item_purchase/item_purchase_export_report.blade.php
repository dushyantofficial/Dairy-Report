@extends('admin.layouts.app')
@section('content')
    @include('admin.flash-message')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-6">
                             <a class="btn btn-outline-danger"
                    href="{{route('item-purchase-report-pdf')}}?field={{request()}}">
                                Pdf</a>
 <button type="button" onclick="ExportToExcel('xlsx')" class="btn btn-outline-success">Excel</button>&nbsp;&nbsp;
                            <a class="btn btn-outline-warning" id="Pairings_by_Table_call"
                               href="#">
                                Print </a>
                    <a href="{{route('item-purchase-report-show')}}"><button type="button"
                                                                             class="btn btn-outline-dark">Back</button></a>&nbsp</span><br><br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.item_purchase_report_table')</h5>
                            <div class="tile-body" id="my_report">
                                <table id="sampleTable" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>@lang('langs.customer_no')</th>
                                        @if(isset($input['field']['item_name_id']))
                                            <th> @lang('langs.item_name')</th>

                                        @endif

                                        @if(isset($input['field']['item_quantity']))
                                            <th> @lang('langs.itemQuantity')</th>

                                        @endif

                                        @if(isset($input['field']['Purchase_Rate']))
                                            <th> @lang('langs.Purchase_Rate')</th>

                                        @endif

                                        @if(isset($input['field']['Sales_Rates']))
                                            <th> @lang('langs.Sales_Rates')</th>

                                        @endif

                                        @if(isset($input['field']['purchase_date']))
                                            <th> @lang('langs.purchase_date')</th>

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
                                    @foreach($item_purchases as $item_purchase)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>

                                            @if(isset($input['field']['item_name_id']))
                                                <td>{{$item_purchase->item_name->item_name}} </td>
                                            @endif
                                            @if(isset($input['field']['item_quantity']))
                                                <td>{{$item_purchase->item_quantity}} </td>
                                            @endif
                                            @if(isset($input['field']['Purchase_Rate']))
                                                <td>{{$item_purchase->Purchase_Rate}} </td>
                                            @endif
                                            @if(isset($input['field']['Sales_Rates']))
                                                <td>{{$item_purchase->Sales_Rates}} </td>
                                            @endif
                                            @if(isset($input['field']['purchase_date']))
                                                <td>{{$item_purchase->purchase_date}} </td>
                                            @endif

                                            @if(isset($input['field']['created_by']))
                                                <td>{{$item_purchase->created_bys->user_name}} </td>
                                            @endif
                                            @if(isset($input['field']['created_at']))
                                                <td>{{$item_purchase->created_at}} </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    $user=\Illuminate\Support\Facades\Auth::user();
                    ?>
                    <div id="table_print">
                        <input type="hidden" id="mandali_address" value="{{$user->mandali_address}}">
                        <input type="hidden" id="mandali_code" value="{{$user->mandali_code}}">
                        <table class="table" id="pri_table" style="display: none">
                            <thead>
                            <tr>
                                <th>@lang('langs.customer_no')</th>
                                @if(isset($input['field']['item_name_id']))
                                    <th> @lang('langs.item_name')</th>

                                @endif

                                @if(isset($input['field']['item_quantity']))
                                    <th> @lang('langs.itemQuantity')</th>

                                @endif

                                @if(isset($input['field']['Purchase_Rate']))
                                    <th> @lang('langs.Purchase_Rate')</th>

                                @endif

                                @if(isset($input['field']['Sales_Rates']))
                                    <th> @lang('langs.Sales_Rates')</th>

                                @endif

                                @if(isset($input['field']['purchase_date']))
                                    <th> @lang('langs.purchase_date')</th>

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
                            @if(isset($item_purchases))
                                @foreach($item_purchases as $item_purchase)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>

                                        @if(isset($input['field']['item_name_id']))
                                            <td>{{$item_purchase->item_name->item_name}} </td>
                                        @endif
                                        @if(isset($input['field']['item_quantity']))
                                            <td>{{$item_purchase->item_quantity}} </td>
                                        @endif
                                        @if(isset($input['field']['Purchase_Rate']))
                                            <td>{{$item_purchase->Purchase_Rate}} </td>
                                        @endif
                                        @if(isset($input['field']['Sales_Rates']))
                                            <td>{{$item_purchase->Sales_Rates}} </td>
                                        @endif
                                        @if(isset($input['field']['purchase_date']))
                                            <td>{{$item_purchase->purchase_date}} </td>
                                        @endif

                                        @if(isset($input['field']['created_by']))
                                            <td>{{$item_purchase->created_bys->user_name}} </td>
                                        @endif
                                        @if(isset($input['field']['created_at']))
                                            <td>{{$item_purchase->created_at}} </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
@push('page_scripts')

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

                frameDoc.document.write('<html><head><title> </title><center>'+mandali_address+'-'+mandali_code+'<center>Bank Payment Statement<br><center>Date:'+date+'');
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
                $('#pri_table').attr("style","display:none");
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

