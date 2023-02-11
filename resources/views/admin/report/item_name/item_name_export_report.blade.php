@extends('admin.layouts.app')
@section('content')

    @include('admin.flash-message')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                         <span class="pull-right float-right"><button type="button" onclick="printreportData()"
                                                                      class="btn btn-outline-warning">Print</button>&nbsp;&nbsp;
                          <a class="btn btn-outline-danger"
                             href="{{route('item-name-report-pdf')}}?field={{request()}}">
                                Pdf </a>
                    <button type="button" onclick="ExportToExcel('xlsx')" class="btn btn-outline-success">Excel</button>&nbsp;&nbsp;

                    <a href="{{route('item-name-report-show')}}"><button type="button"
                                                                         class="btn btn-outline-dark">Back</button></a>&nbsp</span><br><br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.item_name_report_table')</h5>
                            <div class="tile-body" id="my_report">
                                <table id="sampleTable" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>@lang('langs.customer_no')</th>

                                        @if(isset($input['field']['item_name']))
                                            <th> @lang('langs.item_name')</th>

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
                                    @foreach($item_name_reports as $item_name_report)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>

                                            @if(isset($input['field']['item_name']))
                                                <td>{{$item_name_report->item_name}} </td>
                                            @endif
                                            @if(isset($input['field']['created_by']))
                                                <td>{{$item_name_report->created_bys->user_name}} </td>
                                            @endif
                                            @if(isset($input['field']['created_at']))
                                                <td>{{$item_name_report->created_at}} </td>
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



    <!-- Modal -->
@endsection
@push('page_scripts')

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
