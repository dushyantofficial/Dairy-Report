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
                            <form class="row g-3" action="{{route('item_sales.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <h1 class="card-title">@lang('langs.choose_payment_date')</h1>
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">@lang('langs.from_date')</label>
                                    <input type="date" name="PayFromDT" value="{{old('PayFromDT')}}"
                                           class="form-control @error('PayFromDT') is-invalid @enderror"
                                           id="inputNanme4">
                                    @error('PayFromDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.to_date')</label>
                                    <input type="date" name="PayToDT" value="{{old('PayToDT')}}"
                                           class="form-control @error('PayToDT') is-invalid @enderror" id="inputEmail4">
                                    @error('PayToDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <select
                                        class="form-control select2 @error('from_morning_evening') is-invalid @enderror"
                                        name="from_morning_evening">
                                        <option
                                            value="morning" {{ old('from_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.morning')</option>
                                        <option
                                            value="evening" {{ old('from_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.evening')</option>
                                    </select>
                                    @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <select class="form-control @error('to_morning_evening') is-invalid @enderror"
                                            name="to_morning_evening">
                                        <option
                                            value="morning" {{ old('to_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.morning')</option>
                                        <option
                                            value="evening" {{ old('to_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.evening')</option>
                                    </select>
                                    @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h1 class="card-title">@lang('langs.choose_deduct_date')</h1>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.from_date')</label>
                                    <input type="date" name="DeductFromDT" value="{{old('DeductFromDT')}}"
                                           class="form-control @error('DeductFromDT') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('DeductFromDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.to_date')</label>
                                    <input type="date" name="DeductToDT" value="{{old('DeductToDT')}}"
                                           class="form-control @error('DeductToDT') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('DeductToDT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Deduct_Rate')</label>
                                    <input type="text" name="Deduct_Rate" value="{{old('Deduct_Rate')}}"
                                           class="form-control @error('Deduct_Rate') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Deduct_Rate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Total_DT')</label>
                                    <input type="text" name="Total_DT" value="{{old('Total_DT')}}"
                                           class="form-control @error('Total_DT') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Total_DT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.Total_Rate')</label>
                                    <input type="number" name="Total_Rate" value="{{old('Total_Rate')}}"
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
                                                value="{{$customer->id}}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{$customer->customer_name}}</option>
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
                                                value="{{$item_names->id}}" {{ old('item_name_id') == $item_names->id ? 'selected' : '' }}>{{$item_names->item_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('item_name_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.itemQuantity')</label>
                                    <input type="number" name="itemQuantity" value="{{old('itemQuantity')}}"
                                           class="form-control @error('itemQuantity') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('itemQuantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.CustPhoto')</label>
                                    <input type="file" name="CustPhoto" value="{{old('CustPhoto')}}"
                                           class="form-control @error('CustPhoto') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('CustPhoto')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-primary">@lang('langs.save')</button>
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
