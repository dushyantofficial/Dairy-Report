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
                                    <input type="date" name="payment_from_date" value="{{old('payment_from_date')}}"
                                           class="form-control @error('payment_from_date') is-invalid @enderror"
                                           id="from_date">
                                    @error('payment_from_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.to_date')</label>
                                    <input type="date" name="payment_to_date" value="{{old('payment_to_date')}}"
                                           class="form-control @error('payment_to_date') is-invalid @enderror"
                                           id="to_date">
                                    @error('payment_to_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <select
                                        class="form-control"
                                        name="from_morning_evening">
                                        <option
                                            value="morning" {{ old('from_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.morning')</option>
                                        <option
                                            value="evening" {{ old('from_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.evening')</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control"
                                            name="to_morning_evening">
                                        <option
                                            value="morning" {{ old('to_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.morning')</option>
                                        <option
                                            value="evening" {{ old('to_morning_evening') == request()->to_morning_evening ? 'selected' : '' }}>@lang('langs.evening')</option>
                                    </select>
                                </div>
                                <h1 class="card-title">@lang('langs.choose_deduct_date')</h1>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.from_date')</label>
                                    <input type="date" name="deduct_from_date" value="{{old('deduct_from_date')}}"
                                           class="form-control @error('deduct_from_date') is-invalid @enderror"
                                           id="deduct_from_date">
                                    @error('deduct_from_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.to_date')</label>
                                    <input type="date" name="deduct_to_date" value="{{old('deduct_to_date')}}"
                                           class="form-control @error('deduct_to_date') is-invalid @enderror"
                                           id="deduct_to_date">
                                    @error('deduct_to_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.entry_date')</label>
                                    <input type="date" name="entry_date" value="{{old('entry_date')}}"
                                           class="form-control @error('entry_date') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('entry_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label"></label>
                                    <label for="inputEmail4" class="form-label"></label>
                                    <select class="form-control"
                                            name="deduct_morning_evening">
                                        <option
                                            value="morning" {{ old('deduct_morning_evening') == request()->deduct_morning_evening ? 'selected' : '' }}>@lang('langs.morning')</option>
                                        <option
                                            value="evening" {{ old('deduct_morning_evening') == request()->deduct_morning_evening ? 'selected' : '' }}>@lang('langs.evening')</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="inputEmail4" class="form-label">@lang('langs.payment')</label>
                                    <input type="number" name="payment" value="{{old('payment')}}"
                                           class="form-control @error('payment') is-invalid @enderror"
                                           id="payment" readonly>
                                    @error('payment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="inputEmail4" class="form-label">@lang('langs.deduct_payment')</label>
                                    <input type="number" name="deduct_payment" value="{{old('deduct_payment')}}"
                                           class="form-control @error('deduct_payment') is-invalid @enderror"
                                           id="deduct_payment" readonly>
                                    @error('deduct_payment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="inputEmail4" class="form-label">@lang('langs.total')</label>
                                    <input type="number" name="total" value="{{old('total')}}"
                                           class="form-control @error('total') is-invalid @enderror"
                                           id="total" readonly>
                                    @error('total')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.customer_name')</label>
                                    <select class="form-control select2 @error('customer_id') is-invalid @enderror"
                                            name="customer_id" id="customer_id">
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
                                    <select class="form-control select2 @error('item_name_id') is-invalid @enderror"
                                            name="item_name_id" id="opt_level">
                                        <option value="">---@lang('langs.select_item_name')---</option>
                                        @foreach($item_namess as $item_names)
                                            <option
                                                value="{{$item_names->id}}" {{ old('item_name_id') == $item_names->id ? 'selected' : '' }}>{{$item_names->item_name->item_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('item_name_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.itemQuantity')</label>
                                    <input type="number" name="item_quantity" value="{{old('item_quantity')}}"
                                           class="form-control @error('item_quantity') is-invalid @enderror"
                                           id="item_quantity">
                                    @error('item_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.total_quantity')</label>
                                    <input type="number" name="total_quantity" value="{{old('total_quantity')}}"
                                           class="form-control @error('total_quantity') is-invalid @enderror"
                                           id="total_quantity">
                                    @error('item_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">@lang('langs.CustPhoto')</label>
                                    <input type="file" name="customer_photo" value="{{old('customer_photo')}}"
                                           class="form-control @error('customer_photo') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('customer_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" value="" id="qitme">
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
@push('page_scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.select2').select2();
        });


        $(document).ready(function ($) {
            $("#opt_level").on('change', function () {

                var level = $(this).val();
                // alert(level);
                if (level) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('get_quantity') }}",
                        data: {'id': level},
                        success: function (data) {
                            // console.log();
                            $('#qitme').val(data.item_quantity);

                            // console.log(qitme);
                        }
                    });
                }
            });


            $("#customer_id").on('change', function () {
                var id = $(this).val();
                var to_date = $('#deduct_to_date').val();
                var from_date = $("#deduct_from_date").val();
                // alert(to_date, from_date);
                if (id) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('get_payment') }}",
                        data: {'id': id, 'to_date': to_date, 'from_date': from_date},
                        success: function (data) {
                            // console.log(data);
                            var payment = data.final_amount;
                            var deduct_paymen = data.deduct_payment;
                            var total = payment - deduct_paymen;
                            $('#payment').val(payment);
                            $('#deduct_payment').val(deduct_paymen);
                            $('#total').val(total);


                        }
                    });
                }
            });

            $('#item_quantity').on('keyup', function () {
                var tval = $(this).val();
                var qitme = $('#qitme').val();
                // alert(qitme);
                if (tval < qitme) {

                } else {
                    alert('Please enter valid item quantity');
                    $('#item_quantity').val(' ');
                }

            });
        });
    </script>
@endpush
