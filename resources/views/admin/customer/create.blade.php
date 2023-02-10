@extends('admin.layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('langs.customer')</h1>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('langs.customer_form')</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('customer.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf

                                    <div class="col-12">
                                    <label for="inputNanme4" class="form-label">@lang('langs.user_name')</label>

                                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                                            id="users">
                                        <option value="">---@lang('langs.select_user_name')---</option>
                                        @foreach($users as $user)
                                            <option
                                                value="{{$user->id}}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->user_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.customer_name')</label>
                                    <input type="text" name="customer_name" value="{{old('customer_name')}}"
                                           class="form-control @error('customer_name') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('customer_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.customer_code')</label>
                                    <input type="text" name="customer_code" value="{{old('customer_code')}}"
                                           class="form-control @error('customer_code') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('customer_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.bank_name')</label>
                                    <input type="text" name="bank_name" value="{{old('bank_name')}}"
                                           class="form-control @error('bank_name') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('bank_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.account_number')</label>
                                    <input type="number" name="account_number" value="{{old('account_number')}}"
                                           class="form-control @error('account_number') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('account_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.ifsc_code')</label>
                                    <input type="text" name="ifsc_code" value="{{old('ifsc_code')}}"
                                           class="form-control @error('ifsc_code') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('ifsc_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">@lang('langs.final_amount')</label>
                                    <input type="number" name="final_amount" value="{{old('final_amount')}}"
                                           class="form-control @error('final_amount') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('final_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-primary">@lang('langs.save')</button>
                                    <a href="{{route('customer.index')}}" type="reset"
                                       class="btn btn-outline-secondary">@lang('langs.back')</a>
                                    {{--                                    <button type="reset" class="btn btn-secondary">Back</button>--}}
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
    <script>
        (function ($) {

            $.fn.select3 = function (options) {
                var dataItems = [];
                var selectorID = '#' + this.attr('id');

                $(selectorID).find('option').each(function (index, element) {

                    if (element.text != '') {
                        dataItems.push(element.text.trim());
                    }
                    else {
                        dataItems.push(element.value.trim());
                    }

                });

                var opts = $.extend({}, $.fn.select3.defaults, options);

                var idDiv = this.attr('id') + 'searchSelect3';
                var idInput = this.attr('id') + 'searchSelect3_Input';
                var idClose = this.attr('id') + 'searchSelect3_Times';
                var idDown = this.attr('id') + 'searchSelect3_Caret_Down';
                var idList = this.attr('id') + 'searchSelect3_List';
                var idListLi = this.attr('id') + 'searchSelect3_List_LI';

                var selectorDiv = '#' + this.attr('id') + 'searchSelect3';
                var selectorInput = '#' + this.attr('id') + 'searchSelect3_Input';
                var selectorClose = '#' + this.attr('id') + 'searchSelect3_Times';
                var selectorDown = '#' + this.attr('id') + 'searchSelect3_Caret_Down';
                var selectorList = '#' + this.attr('id') + 'searchSelect3_List';
                var selectorListLi = '#' + this.attr('id') + 'searchSelect3_List_LI';

                var buildELement = $('<div class="searchSelect3" id="' + idDiv + '" style="position:relative;"><input class="searchSelect3_Input" placeholder="' + opts.placeholder + '" value="' + opts.defaultvalue + '" id="' + idInput + '"><span class="fa fa-times searchSelect3_Times" id="' + idClose + '"></span><span class="fa fa-caret-down searchSelect3_Caret_Down" id="' + idDown + '"></span></div>');

                if ($(selectorDiv).length > 0) {
                    $(selectorDiv).remove();
                }

                this.after(buildELement);

                if (opts.width > 0) {
                    $(selectorInput).css('width', opts.width);
                    $(selectorDown).css('left', (opts.width - 20));
                    $(selectorClose).css('left', (opts.width - 40));
                }


                var cache = {};
                var drew = false;
                this.hide();



                $(document).on('click', function (e) {
                    //untuk menghilangkan list saat unfocus
                    if ($(e.target).parent().is("li[id*='" + idListLi + "']") == false) {
                        if ($(e.target).attr('id') != idInput && $(e.target).attr('id') != idDown) {
                            $(selectorList).empty();
                            $(selectorList).css('z-index', -1);
                            $(selectorClose).hide();
                        }
                    }



                });




                var showList = function (query, valuee) {



                    //Check if we've searched for this term before
                    if (query in cache) {
                        results = cache[query];
                    } else {
                        //Case insensitive search for our people array
                        var results = $.grep(dataItems, function (item) {
                            return item.search(RegExp(query, "i")) != -1;
                        });

                        //Add results to cache
                        cache[query] = results;
                    }

                    //First search
                    $(selectorList).css('z-index', opts.zIndex);


                    if (drew == false) {
                        //Create list for results
                        $(selectorInput).after('<ul id="' + idList + '" class="searchSelect3_List" style="z-index:' + opts.zIndex + '"></ul>');

                        if (opts.width > 0) {

                            $(selectorList).css('width', opts.width);

                        }

                        if (opts.widthList > 0)
                        {
                            $(selectorList).css('width', opts.widthList);
                        }

                        //Prevent redrawing/binding of list
                        drew = true;

                        //Bind click event to list elements in results
                        $(selectorList).on("click", "li", function () {
                            var nilai = $(this).text()
                            $(selectorInput).val(nilai);
                            $(selectorID).val(nilai);
                            $(selectorList).empty();
                            $(selectorClose).show();
                            $(selectorList).css('z-index', -1);
                            $(selectorID).change();
                        });


                    }
                    //Clear old results
                    else {
                        $(selectorList).empty();
                    }

                    var counter = 0;
                    //Add results to the list
                    for (term in results) {
                        counter++;
                        $(selectorList).append("<li id=" + idListLi + counter + "><label>" + results[term] + "</label></li>");
                    }




                };



                $(selectorInput).on('click', function (e) {
                    var query = $(this).val();

                    showList('', query);


                    $(selectorClose).hide();
                    if (query.length > 0) {
                        $(selectorClose).show();
                    }

                });

                $(selectorInput).on('keyup', function (e) {
                    $(selectorList).empty();
                    var query = $(selectorInput).val();
                    showList(query, query);

                    $(selectorClose).hide();
                    if (query.length > 0) {
                        $(selectorClose).show();
                    }

                    $(selectorID).change();
                });

                //bila key tab di tekan maka akan pindah ke DOM lain, maka dari itu mesti di HIDE LIST nya
                $(selectorInput).on('keydown', function (e) {
                    if (e.which == 9) {
                        $(selectorList).empty();
                        $(selectorList).css('z-index', -1);
                        $(selectorClose).hide();
                    }
                });

                $(selectorDown).on('click', function (e) {
                    var query = $(this).val();
                    if ($(selectorList).find('li').length == 0) {
                        showList('', query);
                    }
                    else {
                        //$(selectorList).css('z-index', -1);
                        $(selectorList).empty();
                        $(selectorList).css('z-index', -1);
                    }

                    $(selectorClose).hide();
                    if (query.length > 0) {
                        $(selectorClose).show();
                    }

                });

                $(selectorClose).on('click', function (e) {
                    $(selectorInput).val('');
                    $(selectorClose).hide();
                    $(selectorID).change();

                });


                return this;
            };

            $.fn.select3.defaults = {
                placeholder: "",
                zIndex: 1,
                defaultvalue: "",
                width: 0,
                widthList: 0
            };

        }(jQuery));
        /* END select3.js */


        $(document).ready(function(e){

            $('#selectBankList').select3({ width: 260, placeholder: 'Pilih Metode Pelunasan', zIndex: 100 });

            $('#selectDescription').select3({ width: 400, placeholder: 'Pilih Description', zIndex: 100, widthList:800 });


        });

    </script>
    @endpush
