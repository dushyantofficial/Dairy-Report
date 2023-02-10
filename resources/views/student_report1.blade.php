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
                        <form id="myform" action="" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Select Class:</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="name" id="department_id" class="form-control" required>
                                        <option value="">Select Class</option>
                                        {{--                                    @foreach($classes as $class)--}}
                                        {{--                                        <option value="{{$class->id}}">{{$class->department->name}}-{{$class->name}}</option>--}}
                                        {{--                                    @endforeach--}}

                                    </select>
                                    <span style="color: red">@error('department_name'){{$message}}@enderror</span>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Fields:</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="checkbox" id="name" name="field[name]" value="name">
                                    <label for="name"> Name </label><br>
                                    <input type="checkbox" id="admission_number" name="field[admission_number]"
                                           value="admission_number">
                                    <label for="admission_number"> Admission No</label><br>
                                    {{--                                <input type="checkbox" id="class_name" name="name" value="class_name">--}}
                                    {{--                                <label for="class"> Class</label><br>--}}
                                    {{--                                <input type="checkbox" id="dep_name" name="name" value="dep_name">--}}
                                    {{--                                <label for="department">Department</label><br>--}}
                                    <input type="checkbox" id="gender" name="field[gender]" value="gender">
                                    <label for="gender"> Gender </label><br>
                                    <input type="checkbox" id="blood_group" name="field[blood_group]"
                                           value="blood_group">
                                    <label for="blood_group"> Blood Group </label><br>
                                    <input type="checkbox" id="email" name="field[email]" value="email">
                                    <label for="email"> Email</label><br>
                                    <input type="checkbox" id="village" name="field[village]" value="village">
                                    <label for="village"> Village </label><br>


                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" id="created_at" name="field[created_at]" value="created_at">
                                    <label for="admission_date"> Admission Date</label><br>
                                    <input type="checkbox" id="dob" name="field[dob]" value="dob">
                                    <label for="dob">Date of Birth</label><br>
                                    <input type="checkbox" id="birth_place" name="field[birth_place]"
                                           value="birth_place">
                                    <label for="birth_place"> Birth Place</label><br>
                                    <input type="checkbox" id="cast" name="field[cast]" value="cast">
                                    <label for="category"> Category</label><br>
                                    <input type="checkbox" id="mobile" name="field[mobile]" value="mobile">
                                    <label for="mobile"> Mobile Number</label><br>
                                    <input type="checkbox" id="state" name="field[state]" value="state">
                                    <label for="state"> State</label><br>


                                </div>
                                <div class="col-md-2">

                                    <input type="checkbox" id="city" name="field[city]" value="city">
                                    <label for="city"> City</label><br>

                                    <input type="checkbox" id="address" name="field[address]" value="address">
                                    <label for="address"> Current Address</label><br>
                                    {{--                                <input type="checkbox" id="address" name="field[address]" value="address">--}}
                                    {{--                                <label for="address"> Perment Address</label><br>--}}
                                    <input type="checkbox" id="parent_mobile" name="field[parent_mobile]"
                                           value="parent_mobile">
                                    <label for="parent_mobile"> Father Phone</label><br>
                                    <input type="checkbox" id="mother_name" name="field[mother_name]"
                                           value="mother_name">
                                    <label for="mother_name"> Mother Name</label><br>
                                    <input type="checkbox" id="pincode" name="field[pincode]" value="pincode">
                                    <label for="pincode"> Pincode</label><br>
                                    <input type="checkbox" id="district" name="field[district]" value="district">
                                    <label for="district"> District</label><br><br>

                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" id="enrollment_number" name="field[enrollment_number]"
                                           value="enrollment_number">
                                    <label for="enrollment_number"> Enrollment Number </label>
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
