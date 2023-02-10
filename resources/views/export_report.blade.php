@extends('admin.layouts.app')
@section('title')
    Student Custome Report
@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">

            <div class="section-body">

                <span class="pull-right float-right"><button type="button" onclick="printreportData()"
                                                             class="btn btn-info">Print</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-primary" onclick="pdfreport()">Pdf File</button>&nbsp;&nbsp;
                <button type="button" onclick="ExportToExcel('xlsx')" class="btn btn-success">Excel File</button>&nbsp;&nbsp;

                    <a href="{{route('student_report')}}"><button type="button" class="btn btn-danger">Back</button></a>&nbsp</span><br><br>

                <div id="my_report">


                    <table class="table table-bordered table-responsive text-center" class="my_report">

                        <tr class="text-white" style="background-color: #6c757d">

                            <th>No</th>

                            @if(isset($input['field']['item_name']))
                                <th> @lang('langs.item_name')</th>

                            @endif



                            @if(isset($input['field']['created_at']))
                                <th> Created Date</th>

                            @endif

                        </tr>
                        @foreach($admissions as $admission)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                @if(isset($input['field']['item_name']))
                                    <td>{{$admission->item_name}} </td>
                                @endif
                                @if(isset($input['field']['created_at']))
                                    <td>{{$admission->created_at}} </td>
                                @endif

                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('page_scripts')

    <script>
        function printreportData() {
            var print_ = document.getElementById("my_report");
            win = window.open("");
            win.document.write(print_.outerHTML);
            win.print();
            win.close();
            //window.print();

        }

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

