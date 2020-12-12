@extends('layouts.default')
@section('title','Pin Code Number Finder - Search Any Pincode of India at Pincode Wala')
@section('description','')
@section('content')
<section class="banner-w">
        <div class="container">
            <div class="row search-w">
                <div class="col-md-12">
                    <h2 class="title">FIND YOUR PIN CODE HERE</h2>
                </div>
                <div class="col-md-6 border-right mt-5">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="state_search">State *</label>
                            <select class="form-control select2" id="state_search" placeholder="Select your state">
                            <option disabled selected value=''>Select State</option>
                            @if(isset($state_list) && !empty($state_list))
                            @foreach($state_list as $state)    
                                <option  data-slug="{{$state->seo_url}}" value="{{$state->state_code}}">{{$state->state}}</option>
                            @endforeach    
                            @endif    
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="">District *</label>
                            <select class="form-control select2"  id="district_search" placeholder="Select your District">
                            <option disabled selected> Select District</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="">Loaction *</label>
                            <select class="form-control select2" id="location" placeholder="Select your Location">
                            <option disabled selected> Select Location</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2 text-center mt-4">
                        <button class="btn btn-primary" id="search" type="submit">SEARCH</button>
                    </div>
                </div>
                <div class="col-md-6 m-auto mt-5">
                    
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="">Search using pin code *</label>
                                <input type="text" id="pincode_no" name="pincode" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8 offset-md-2 text-center mt-4">
                            <button id="pincode_search" class="btn btn-primary" type="submit">SEARCH</button>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!--end search section-->
    <!-- State listing -->
    <section class="state-w">
        <div class="container listing-w">
                <div class="row ">
                    <span class="title">Find State Wise Pin Code </span>
                </div>
                <div class="row grey-bg">
                    @if(isset($state_list) && !empty($state_list))
                        @foreach($state_list as $state)           
                           <div class="col-md-3 col-6">
                                <a href="{{url('/')}}{{$state->seo_url}}"><li class="">{{$state->state}}</li></a>
                            </div>
                        @endforeach    
                    @endif
                </div>
        </div>
    </section>

    <section class="state-w">
        <div class="container listing-w">
                <div class="row ">
                    <span class="title">Top Cities Pin Code</span>
                </div>
                <div class="row grey-bg">
                     @if(isset($top_city_list) && !empty($top_city_list))
                        @foreach($top_city_list as $city)           
                           <div class="col-md-3 col-6">
                                <a href="{{url('/')}}{{$city->seo_url}}"><li class="">{{$city->district}}</li></a>
                            </div>
                        @endforeach    
                    @endif
                </div>
        </div>
    </section>
    <!-- end state listing-->
    <!-- State listing -->
    
    <!-- end state listing-->
    <!--how to find pincode in india-->
    <section class="find-pincide-w">
        <div class="container">
            <div class="row content-w ">
                <div class="col-md-12  p-0">
                    <h2 class="title">How to Find Pin Code in India</h2>
                </div>
                <p>Finding any Pincode in India is easy with Pincode wala. Enter your state name, select the district and city you belong, you will get the list of all localities of your city. Select your locality name and get your 6 digit Pincode number.</p>
                <div class="col-md-12  p-0">
                    <h2 class="title">What is Pincode?</h2>
                </div>
                <p>Pincode (Personal Identification Number) is the 6 digit numeric code used by the Indian postal service.</p>
                  <div class="col-md-12  p-0">
                    <h2 class="title">Why Indian Pincode Have Six Digits & What They Indicate?</h2>
                </div>
                <p>The Indian Pincode is using the combination of the zone, state, and specific locality and it's divided into three parts as follows :<br>The first digit is assigned for the zone and entire India is divided into nine zones.</
                <br>The second digit is assigned to the state/region. And the last 3 digits are assigned for specific post office.</p>
            </div>
        </div>
    </section>
    
@push('scripts')
<script>
$('#state_search').select2();
$('#district_search').select2();
$('#location').select2();
$("#state_search").change(function () {
var state_code = $(this).find('option:selected').val();
$('#district_search').empty();
$.ajax({
        type: "GET",
        dataType: "json",
        url: '{{url("/getDistrictByState")}}/'+state_code,
        success: function(district_list) {
            if (district_list) {
                $("#district_search").append('<option value="" disabled selected> Select District</option>');
                $.each(district_list,function(key,value){
                $("#district_search").append('<option data-slug="'+value['seo_url']+'" value="'+value['district_code']+'">'+value['district']+'</option>');            
            });
            } else {
                $("#district_search").append('<option value="" disabled selected> Select District</option>');
            }
        }
    });
});

$("#district_search").change(function () {
var district_code = $(this).find('option:selected').val();
$('#location').empty();
$.ajax({
        type: "GET",
        dataType: "json",
        url: '{{url("/getLocationByDistrict")}}/'+district_code,
        success: function(list) {
            if (list) {
                $("#location").append('<option value="" disabled selected> Select Location</option>');
                $.each(list,function(key,value){
                $("#location").append('<option data-slug="'+value['seo_url']+'" value="'+value['id']+'">'+value['postoffice_name']+'</option>');            
            });
            } else {
                $("#location").append('<option value="" disabled selected> Select Location</option>');
            }
        }
    });
});


$("#search").click(function () {
var state = $('#state_search option:selected').data('slug');  //$('#state_search').find('option:selected').data('slug');
var district = $('#district_search').find('option:selected').data('slug');
var location = $('#location').find('option:selected').data('slug');
if(location) {
    window.location.href = '{{url("/")}}'+location;
} else if(district) {
    window.location.href = '{{url("/")}}'+district;
} else {
    window.location.href = '{{url("/")}}'+state;
}
});

$("#pincode_search").click(function () {
var pincode = $('#pincode_no').val();
 window.location.href = '{{url("pincode")}}/'+pincode;
});
</script>
@endpush
@endsection