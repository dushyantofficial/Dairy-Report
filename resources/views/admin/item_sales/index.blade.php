@extends('admin.layouts.app')

@section('content')

    <main id="main" class="main">
        <section class="section">
            @include('admin.flash-message')
            <div class="row">
                <div class="col-lg-12 float-right mb-5">
            <span class="pull-right float-right">&nbsp;&nbsp;
 <a class="btn btn-outline-primary" href="{{ route('item_sales.create') }}" style="float: right">
                + @lang('langs.add')
            </a>
            </span></div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.item_sales_table')</h5>
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
                                @foreach($item_saless as $item_sales)
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
                                        {{--                                        <td>--}}
                                        {{--                                            {!! Form::open(['route' => ['item_sales.destroy', $item_sales->id], 'method' => 'delete']) !!}--}}
                                        {{--                                            <div class='btn-group'>--}}
                                        {{--                                                <a href="{{ route('item_sales.edit', [$item_sales->id]) }}"--}}
                                        {{--                                                   class='btn btn-info btn-xs'>--}}
                                        {{--                                                    <i class="bi bi-pencil-square"></i>--}}
                                        {{--                                                </a>--}}
                                        {{--                                                {!! Form::button('<i class="bi bi-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                                        {{--                                            </div>--}}
                                        {{--                                            {!! Form::close() !!}--}}
{{--                                        </td>--}}

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


