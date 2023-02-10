@extends('admin.layouts.app')
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
                @include('admin.flash-message')
                <div class="card">
                    <div class="card-body">
                        <form id="myform" action="{{route('student_report_export')}}" method="get">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Fields:</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="checkbox" id="name" name="field[item_name]" value="item_name">
                                    <label for="name"> @lang('langs.item_name') </label><br>


                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" id="created_at" name="field[created_at]" value="created_at">
                                    <label for="admission_date"> Created Date</label><br>

                                </div>
                            </div>
                            <div class="text-center" style="margin-left: 200px;">
                                &nbsp;
                                <button type="submit" class="btn btn-info">View File</button>&nbsp;&nbsp;
                                &nbsp;
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </section>
    </main>
