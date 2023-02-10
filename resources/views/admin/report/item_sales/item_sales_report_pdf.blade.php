<html>
<head>
    <style>
        /*#ascrail2002 {*/
        /*    z-index: 0 !important;*/
        /*}*/

        /*.nicescroll-rails-vr {*/
        /*    z-index: 0;*/
        /*}*/

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
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Item Sales Reports</h1>
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
                            <th style="padding: 7px;">@lang('langs.PayFromDT')</th>
                            <th style="padding: 7px;">@lang('langs.PayToDT')</th>
                            <th style="padding: 7px;">@lang('langs.Payment_Rate')</th>
                            <th style="padding: 7px;">@lang('langs.DeductFromDT')</th>
                            <th style="padding: 7px;">@lang('langs.DeductToDT')</th>
                            <th style="padding: 7px;">@lang('langs.Deduct_Rate')</th>
                            <th style="padding: 7px;">@lang('langs.Total_DT')</th>
                            <th style="padding: 7px;">@lang('langs.Total_Rate')</th>
                            <th style="padding: 7px;">@lang('langs.itemQuantity')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item_sales_reports as $item_sales_report)
                            <tr style="text-align: center;">
                                <td style="padding: 7px;">{{ $loop->iteration }}</td>
                                <td style="padding: 7px;">{{$item_sales_report->customers->customer_name}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->item_names->item_name}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->PayFromDT}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->PayToDT}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->Payment_Rate}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->DeductFromDT}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->DeductToDT}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->Deduct_Rate}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->Total_DT}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->Total_Rate}}</td>
                                <td style="padding: 7px;">{{$item_sales_report->itemQuantity}}</td>
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

