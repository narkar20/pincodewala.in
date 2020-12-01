@extends('layouts.default')
@section('title','Pincode')
@section('content')
<section class="b-w">
        <div class="container ">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/')}}">Pincode</a></li>
                @if(isset($pincode) && !empty($pincode))<li class="breadcrumb-item"><a>{{$pincode ?? ''}}</a></li>@endif
            </ol>
        </div>
    </section>
    <!-- end breadcrums -->
    <!--location-w-->
    <section class="location-w">
        <div class="container ">
            <div class="row m-0">
                <!-- <span class="title">Nilje Pin Code</span> -->
            </div>
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="4" class="bg-red">Data for Pincode {{ $pincode ?? '' }} </th>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <th>Pin Code</th>
                        <th>District</th>
                        <th>State</th>
                        
                    </tr>
                </thead>
                <tbody>
                @if(isset($records) && !empty($records))
                    @foreach($records as $record)
                   
                    <tr>
                        <td><a href="{{url('/')}}/{{$record->location_seo_url}}">{{$record->postoffice_name}}</a></td>
                        <td><a href="{{url('pincode')}}{{$record->pincode}}">{{$record->pincode}}</a></td>
                        <td><a href="{{url('/')}}{{$record->district_seo_url}}">{{$record->district_name}}</a></td>
                        <td><a href="{{url('/')}}{{$record->state_seo_url}}">{{$record->state_name}}</a></td>
                    </tr>
                    @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
    </section>
    