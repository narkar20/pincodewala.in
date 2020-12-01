@extends('layouts.default')
@section('title','District')
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
                            <option disabled selected value=''> Select State</option>
                            @if(isset($state_list) && !empty($state_list))
                            @foreach($state_list as $state)    
                                <option value="{{$state->state_code}}">{{$state->state}}</option>
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
                            <option disabled selected> Select Loaction</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2 text-center mt-4">
                        <button class="btn btn-primary" id="search" type="submit">SEARCH</button>
                    </div>
                </div>
                <div class="col-md-6 m-auto mt-5">
                    <form action="{{url('location')}}" method="GET">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="">Search using pin code *</label>
                                <input type="text" name="pincode" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8 offset-md-2 text-center mt-4">
                            <button class="btn btn-primary" type="submit">SEARCH</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--end search section-->
    <!-- State listing -->
    <section class="state-w">
        <div class="container listing-w">
                <div class="row ">
                    <span class="title">State list</span>
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
    <!-- end state listing-->
    <!-- State listing -->
    
    <!-- end state listing-->
    <!--how to find pincode in india-->
    <section class="find-pincide-w">
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
                $("#district_search").append('<option value="'+value['district_code']+'">'+value['district']+'</option>');            
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
                $("#location").append('<option value="'+value['id']+'">'+value['postoffice_name']+'</option>');            
            });
            } else {
                $("#location").append('<option value="" disabled selected> Select Location</option>');
            }
        }
    });
});


$("#search").click(function () {
var state_code = $('#state_search').find('option:selected').val();
var district_code = $('#district_search').find('option:selected').val();
var location = $('#location').find('option:selected').val();

if(location) {
    window.location.href = '{{url("location")}}';
} else if(district_code) {

    window.location.href = '{{url("district?district=")}}'+district_code;
} else {
    window.location.href = '{{url("state/")}}'+state_code;
}
});
</script>
@endpush
@endsection