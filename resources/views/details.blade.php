@extends('layouts.default')
@section('title','Location')
@section('content')
<!--breadcrums-->
 <section class="b-w">
        <div class="container ">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                @if(isset($location_name) && !empty($location_name))<li class="breadcrumb-item"><a href="{{url('/location')}}/{{$location_name}}">{{ucwords($location_name)}}</a></li>@endif
            </ol>
        </div>
    </section>
    <!-- end breadcrums -->
    <!--state-w-->
        <section class="state-w">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="email">Distict *</label>
                        <select class="form-control select2" id="seo_url" placeholder="Select your district">
                            <option selected disabled> Select District</option>
                           @if(isset($district_list) && !empty($district_list))
                           @foreach($district_list as $district)
                              <option value="{{$district->district_code}}" data-seo_url="{{$district->seo_url}}">{{$district->district}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="">Search using pin code *</label>
                        <select class="form-control select2" id="pincode" placeholder="Enter 3 digit of Pin-code">
                            <option></option>
                          
                        </select>
                    </div>
                </div>
                <div class="col-md-2  text-center pt-3">
                    <button class="btn btn-primary" id="search" type="button">SEARCH</button>
                </div>
            </div>
        </div>
    </section>
    <!--location-w-->
    <section class="location-w">
        <div class="container ">
            <div class="row m-0">
            </div>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="4" class="bg-red">Pin Code Details</th>
                    </tr>
                    <tr>
                        <th>Pin Code</th>
                        <th>Region</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>421204</td>
                        <td>Maharashtra</td>
                        <td>Kalyan, Dombivali, Dombivli East</td>
                    </tr>
                    <tr>
                        <td>421204</td>
                        <td>Maharashtra</td>
                        <td>Kalyan, Dombivali</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>
@endpush
@endsection
