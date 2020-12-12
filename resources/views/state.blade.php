@extends('layouts.default')
@section('title',$state->seo_title ?? '')
@section('description',$state->seo_description ?? '')
@section('content')
    <!--breadcrums-->
    <section class="b-w">
        <div class="container">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                @if(isset($state_name) && !empty($state_name))<li class="breadcrumb-item"><a href="{{ Request::url() }}">{{$state->state}}</a></li>@endif
            </ol>
        </div>
    </section>
    <section class="location-w">
        <div class="container ">
            <div class="row m-0">
            </div>
            <table id="example" class="table table-striped table-bordered col-md-8" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="4" class="bg-red"> {{$state->state ?? ''}} Pin Code List</th>
                    </tr>
                    <tr>
                        <th>District</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody class="scrollbar">
                    @if(isset($state_list) && !empty($state_list))
                    @foreach($state_list as $state)
                    <tr>
                        <td><a href="{{url('/')}}{{$state->district_seo_url}}">{{$state->district}}</a></td>
                        <td>{{$state->state}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
    <!-- end location-w -->
    <!--how to find pincode in india-->
    <section class="find-pincide-w grey-bg">
        <div class="container">
            <div class="row content-w ">
                <div class="col-md-12  p-0">
                    <h2 class="title">How to find pincode in India</h2>
                </div>
                <p>Finding any Pincode in india is easy with Poncode wala.Enter your state name,select the district and city you belong,you will get the list of all localities of your city.Select your locality name and get your 6 digit Pincode number. </p>
                <div class="col-md-12  p-0">
                    <h3 class="title">What is Pincode?</h3>
                </div>
                <p>Pincode (Personal Identification Number) is the 6 digit numeric code used by the Indian postal service</p>
                <div class="col-md-12  p-0">
                    <h3 class="title">Why Indian Pincode Have Six Digits & What They Indicate?</h3>
                </div>
                <p>The Indian Pincode is using the combination of the zone,state,and specific locality and it's divided into three parts as follows :</p>
                <ul class="list-group pl-5">
                    <li class="">The first digit is assigned for the zone.India divided into nine zones.</li>
                    <li class="">The second digit is assigned to the state/region.</li>
                    <li class="">The second digit is assigned to the state/region.</li>
                    <li class="">And the last 3 digits are assigned for specific post office.</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end how to find pincode in india-->
@endsection
