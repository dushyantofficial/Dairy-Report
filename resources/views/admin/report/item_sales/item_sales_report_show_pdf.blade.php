<html>
<head>
    <style>


        @media print {
            .player-chart nice {
                width: 100%;
            }

            div table {
                width: 100%;
                margin: 0;

            }

            .print-table {
                max-width: 100%;
                border: 1px solid #000;
                border-collapse: collapse;
            }

            .print-table #leader {
                max-width: 100%;
                border: 1px solid #000;
                border-collapse: collapse;
            }
        }

    </style>
</head>
<body>
<section class="content-header">
    <div class="container-fluid">
        @php
            $user = \Illuminate\Support\Facades\Auth::user();
            if (request()->date) {
                $date = request()->date;
                $name = explode(' ', $date);
                $start = date('Y-m-d', strtotime($name[0]));
                $end = date('Y-m-d', strtotime($name[2]));
            }
        @endphp
        <div class="row mb-2">
            <center>  <h2>{{$user->mandali_address}} - {{$user->mandali_code}}</h2>
                <h2>Bank Payment Statement</h2>
                @if (request()->date)
                    <h2>Date :{{$start}} To :{{$end}} Shift :Morning To :Evening</h2>
                @endif
            </center>
            <div class="col-sm-6">
                <h1>@lang('langs.item_purchase_report')</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <div id="leaderBoardSwissTable" class="print-table">
                    <table id="leader" class="table table-responsive" border="1" width="100%"
                           style="border-collapse: collapse">
                        <thead>
                        <tr class="text-center">
                            <th style="padding: 7px;">@lang('langs.item_sales_no')</th>
                            <th style="padding: 7px;">@lang('langs.customer_name')</th>
                            <th style="padding: 7px;">@lang('langs.item_name')</th>
                            <th style="padding: 7px;">@lang('langs.itemQuantity')</th>
                            <th style="padding: 7px;">@lang('langs.payment_from_date')</th>
                            <th style="padding: 7px;">@lang('langs.payment_to_date')</th>
                            <th style="padding: 7px;">@lang('langs.from_morning_evening')</th>
                            <th style="padding: 7px;">@lang('langs.to_morning_evening')</th>
                            <th style="padding: 7px;">@lang('langs.deduct_from_date')</th>
                            <th style="padding: 7px;">@lang('langs.deduct_to_date')</th>
                            <th style="padding: 7px;">@lang('langs.entry_date')</th>
                            <th style="padding: 7px;">@lang('langs.deduct_morning_evening')</th>
                            <th style="padding: 7px;">@lang('langs.payment')</th>
                            <th style="padding: 7px;">@lang('langs.deduct_payment')</th>
                            <th style="padding: 7px;">@lang('langs.total')</th>
                            <th style="padding: 7px;">@lang('langs.created_by')</th>
                            <th style="padding: 7px;">@lang('langs.created_at')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item_sales_reports as $item_sales_report)
                            <tr style="text-align: center;">
                                <td style="padding: 7px;">{{ $loop->iteration }}</td>
                                <td class="ml-1 mr-1" >{{$item_sales_report->customers->customer_name}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->item_names->item_name->item_name}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->item_quantity}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->payment_from_date}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->payment_to_date}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->from_morning_evening}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->to_morning_evening}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->deduct_from_date}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->deduct_to_date}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->entry_date}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->deduct_morning_evening}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->payment}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->deduct_payment}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->total}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->created_name->user_name}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->created_at}}</td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
</body>
</html>

