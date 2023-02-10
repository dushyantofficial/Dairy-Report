@extends('admin.layouts.app')

@section('content')

    <main id="main" class="main">
        <section class="section">
            @include('admin.flash-message')
            <div class="row">
                <div class="col-lg-12 float-right mb-5">
                    <div class="col-lg-12 float-right mb-5">
            <span class="pull-right float-right">&nbsp;&nbsp;
<a class="btn btn-outline-primary" href="{{ route('user.create') }}"
   style="float: right">
                                                + @lang('langs.add')
                                            </a>
            </span></div>

                </div>

            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive" id="sampleTable">
                        <h5 class="card-title">@lang('langs.user_table')</h5>
                        <table id="sampleTable" class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">@lang('langs.user_no')</th>
                                <th scope="col">@lang('langs.mandali_code')</th>
                                <th scope="col">@lang('langs.mandali_name')</th>
                                <th scope="col">@lang('langs.mandali_address')</th>
                                <th scope="col">@lang('langs.gst_number')</th>
                                <th scope="col">@lang('langs.registration_num')</th>
                                <th scope="col">@lang('langs.customer_name')</th>
                                <th scope="col">@lang('langs.user_name')</th>
                                <th scope="col">@lang('langs.customer_code')</th>
                                <th scope="col">@lang('langs.gender')</th>
                                <th scope="col">@lang('langs.email')</th>
                                <th scope="col">@lang('langs.mobile_number')</th>
                                <th scope="col">@lang('langs.created_by')</th>
                                <th scope="col">@lang('langs.user_action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$user->mandali_code}}</td>
                                    <td>{{$user->mandali_name}}</td>
                                    <td>{{$user->mandali_address}}</td>
                                    <td>{{$user->gst_number}}</td>
                                    <td>{{$user->registration_num}}</td>
                                    <td>{{$user->customer_name}}</td>
                                    <td>{{$user->user_name}}</td>
                                    <td>{{$user->customer_code}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile_number}}</td>
                                    <td>{{$user->created_by }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete']) !!}
                                        <div class='btn-group'>
                                            <a href="{{ route('user.edit', [$user->id]) }}"
                                               class='btn btn-info btn-xs'>
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            {!! Form::button('<i class="bi bi-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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


