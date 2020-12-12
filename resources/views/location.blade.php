@extends('layouts.default')
@section('title',$location_details->seo_title ?? 'District')
@section('description',$location_details->seo_description ?? '' )
@section('content')
<section class="b-w">
        <div class="container ">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                @if(isset($state) && !empty($state))<li class="breadcrumb-item"><a href="{{url('/')}}/{{$state}}">{{ucwords(str_replace('-',' ',$state))}}</a></li>@endif
                @if(isset($district) && !empty($district))<li class="breadcrumb-item"><a href="{{$location_details->district_seo_url}}">{{ucwords(str_replace('-',' ',$district))}}</a></li>@endif
                @if(isset($postoffice_name) && !empty($postoffice_name))<li class="breadcrumb-item"><a href="{{ Request::url() }}">{{ucwords(str_replace('-',' ',$postoffice_name))}}</a></li>@endif
            </ol>
        </div>
    </section>
    <!-- end breadcrums -->
    <!--location-w-->
    <section class="location-w">
        <div class="container ">
            <div class="row m-0">
            </div>
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="4" class="bg-red">{{ ucwords($postoffice_name ?? '').' Pin Code' ?? 'Pincode Details' }} </th>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <th>Pin Code</th>
                        <th>District</th>
                        <th>State</th>
                        
                    </tr>
                </thead>
                <tbody id="results">
                    
                </tbody>
            </table>
        </div>
    </section>
    
@push('scripts')
<script>
    var totalPageNumber = '{{$totalPageNumber ?? 0}}';
    var page = 0; //track user scroll as page number, right now page number is 1
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
