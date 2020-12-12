@extends('layouts.default')
@section('title',$district_details->seo_title ?? 'District')
@section('description',$district_details->seo_description ?? '' )
@section('content')
    <!--breadcrums-->
    <section class="b-w">
        <div class="container ">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                @if(isset($state) && !empty($state))<li class="breadcrumb-item"><a href="{{$district_details->state_seo_url}}">{{ucwords(str_replace('-',' ',$state))}}</a></li>@endif
                @if(isset($district) && !empty($district))<li class="breadcrumb-item"><a href="{{ Request::url() }}">{{ucwords(str_replace('-',' ',$district))}}</a></li>@endif
            </ol>
        </div>
    </section>
    <!-- end breadcrums -->
    <!--location-w-->
    <section class="location-w">
        <div class="container ">
            <div class="row m-0">
            </div>
            <table id="example" class="table table-striped table-bordered col-md-10" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="4" class="bg-red"> {{isset($district) && !empty($district)  ?  ucwords(str_replace('-',' ',$district)).' Pin Code'  : 'Pincode Details' }} </th>
                    </tr>
                    <tr>
                        <th>Post office</th>
                        <th>Pin Code</th>
                        <th>District</th>
                        <th>State</th>
                        
                        
                    </tr>
                </thead>
                <tbody class="scrollbar" id="results">
                    
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
@endsection
@push('scripts')
<script>
    var totalPageNumber = '{{$totalPageNumber ?? 0}}';
    var page = 1; //track user scroll as page number, right now page number is 1
    load_more(page); //initial content load
    $(window).scroll(function() { //detect page scroll
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
            page++; //page number increment

            if (page <= totalPageNumber) {

             load_more(page);
            }
            //load content   
        }
    });

    function load_more(page) {
        $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html",
                beforeSend: function() {
                    $('.ajax-loading').show();
                }
            })
            .done(function(data) {
                console.log(data)
                if (data.length == 0) {
                    console.log(data.length);

                    //notify user if nothing to load
                    // alert('No response from server');
                    // $('.ajax-loading').html("No more records!");
                    // return;
                    $('.ajax-loading').hide();
                }
                $('.ajax-loading').hide(); //hide loading animation once data is received
                $("#results").append(data); //append data into #results element          
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                $('.ajax-loading').hide();
                alert('No response from server');
            });
    }
</script>
@endpush
