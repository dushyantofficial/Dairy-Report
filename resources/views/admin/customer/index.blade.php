@extends('admin.layouts.app')

@section('content')

    <main id="main" class="main">
        <section class="section">
            @include('admin.flash-message')
            <div class="row">
                <div class="col-lg-12 float-right mb-5">

                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ route('import') }}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="file"
                                                       class="form-control @error('file') is-invalid @enderror"><span>
                  @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                <span style="color: red">{{$errors->first('account_number')}}</span><br>
                <span style="color: red">{{$errors->first('customer_name')}}</span><br>
                <span style="color: red">{{$errors->first('user_name')}}</span><br>
                <span style="color: red">{{$errors->first('mobile_number')}}</span>

                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-outline-success">Import</button>
                                            </span>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6" style="margin-left: 201px;">
                                            <a class="btn btn-outline-primary" href="{{ route('customer.create') }}"
                                               style="float: right">
                                                + @lang('langs.add')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive" id="sampleTable">
                            <h5 class="card-title">@lang('langs.customer_table')</h5>
                            <table id="sampleTable" class="table datatable">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('langs.customer_no')</th>
                                    <th scope="col">@lang('langs.customer_name')</th>
                                    <th scope="col">@lang('langs.bank_name')</th>
                                    <th scope="col">@lang('langs.account_number')</th>
                                    <th scope="col">@lang('langs.ifsc_code')</th>
                                    <th scope="col">@lang('langs.final_amount')</th>
                                    <th scope="col">@lang('langs.customer_action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$customer->user->customer_name}}</td>
                                        <td>{{$customer->bank_name}}</td>
                                        <td>{{$customer->account_number}}</td>
                                        <td>{{$customer->ifsc_code}}</td>
                                        <td>{{$customer->final_amount}}</td>
                                        <td>
                                            {!! Form::open(['route' => ['customer.destroy', $customer->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{{ route('customer.edit', [$customer->id]) }}"
                                                   class='btn btn-info btn-xs'>
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                {!! Form::button('<i class="bi bi-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                {{--                                            <a href="{{ route('customer.show', [$customer->id]) }}" class='btn btn-info btn-xs'>--}}
                                                {{--                                                <i class="bi bi-eye" aria-hidden="true"></i>--}}
                                                {{--                                            </a>--}}
                                            </div>
                                            {!! Form::close() !!}
                                        </td>

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


