@extends('admin.layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('langs.item_sales')</h1>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('langs.item_sales_edit_form')</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('item_sales.update',$item_saless->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">@lang('langs.PayFromDT')</label>
                                    <input type="text" name="PayFromDT" value="{{$item_saless->PayFromDT}}"
                                           class="form-control @error('PayFromDT') is-invalid @enderror"
                                           id="inputNanme4">
                                    @error('PayFromDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.PayToDT')</label>
                                    <input type="text" name="PayToDT" value="{{$item_saless->PayToDT}}"
                                           class="form-control @error('PayToDT') is-invalid @enderror" id="inputEmail4">
                                    @error('PayToDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Payment_Rate')</label>
                                    <input type="number" name="Payment_Rate" value="{{$item_saless->Payment_Rate}}"
                                           class="form-control @error('Payment_Rate') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Payment_Rate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.DeductFromDT')</label>
                                    <input type="text" name="DeductFromDT" value="{{$item_saless->DeductFromDT}}"
                                           class="form-control @error('DeductFromDT') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('DeductFromDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.DeductToDT')</label>
                                    <input type="text" name="DeductToDT" value="{{$item_saless->DeductToDT}}"
                                           class="form-control @error('DeductToDT') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('DeductToDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Deduct_Rate')</label>
                                    <input type="text" name="Deduct_Rate" value="{{$item_saless->Deduct_Rate}}"
                                           class="form-control @error('Deduct_Rate') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Deduct_Rate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Total_DT')</label>
                                    <input type="text" name="Total_DT" value="{{$item_saless->Total_DT}}"
                                           class="form-control @error('Total_DT') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Total_DT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Total_Rate')</label>
                                    <input type="number" name="Total_Rate" value="{{$item_saless->Total_Rate}}"
                                           class="form-control @error('Total_Rate') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Total_Rate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.customer_name')</label>
                                    <select class="form-control @error('customer_id') is-invalid @enderror"
                                            name="customer_id">
                                        <option value="">---@lang('langs.select_customer_name')---</option>
                                        @foreach($customers as $customer)
                                            <option
                                                value="{{$customer->id}}" @if(isset($item_saless)){{ $item_saless->customer_id == $customer->id  ? 'selected' : ''}} @endif>{{$customer->customer_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.item_name')</label>
                                    <select class="form-control @error('item_name_id') is-invalid @enderror"
                                            name="item_name_id">
                                        <option value="">---@lang('langs.select_item_name')---</option>
                                        @foreach($item_namess as $item_names)
                                            <option
                                                value="{{$item_names->id}}" @if(isset($item_saless)){{ $item_saless->item_name_id == $item_names->id  ? 'selected' : ''}} @endif>{{$item_names->item_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('item_name_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.itemQuantity')</label>
                                    <input type="number" name="itemQuantity" value="{{$item_saless->itemQuantity}}"
                                           class="form-control @error('itemQuantity') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('itemQuantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.CustPhoto')</label>
                                    <input type="file" name="CustPhoto" value="{{$item_saless->CustPhoto}}"
                                           class="form-control @error('CustPhoto') is-invalid @enderror"
                                           id="inputEmail4">
                                    <img src="{{asset('storage/images/'.$item_saless->CustPhoto)}}" width="60px">
                                    @error('CustPhoto')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-primary">@lang('langs.update')</button>
                                    <a href="{{route('item_sales.index')}}" type="reset"
                                       class="btn btn-outline-secondary">@lang('langs.back')</a>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->


@endsection
