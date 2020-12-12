<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Location;
use App\District;
use URL;
use Input;
use DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $state_list = State::select('id','state','state_code','seo_url')->get();
        $top_city_list = District::select('id','district','state_code','seo_url')->where('is_top_city',1)->get();
        return view('home',compact('state_list','top_city_list'));
    }

    public function getDistrictByState($state_code)
    {
        $district_list = District::select('id','district','district_code','seo_url')->where('state_code',$state_code)->get();
        return response()->json($district_list);
    }

     public function getLocationByDistrict($district_code)
    {
        $location_list = Location::select('id','location.postoffice_name','seo_url')->where('district_code',$district_code)->get();
        return response()->json($location_list);
    }

      public function stateList($state_name =null)
    {
        $state = State::select('state.state','state.state_code','state.seo_url as state_seo_url','district.district','state.seo_title','state.seo_description')
        ->join('district','district.state_code','=','state.state_code')
        ->where('state.seo_url', 'like', '%'.$state_name.'%')
        ->first();
        $state_list = District::select('district.seo_url as district_seo_url','district.id','district.district','district.district_code','district.seo_url','state.state')->join('state','state.state_code','=','district.state_code')
        ->where('district.state_code',$state->state_code)->get();
        return view('state',compact('state_list','state','state_name'));
    }

    
     public function districtList($state,$district,Request $request)
    {   
        $limit = 30;
        $offset = isset($request->page) ? $request->page : 0;
        $query = District::select('district.district as district_name','state.state as state_name','district.seo_url as district_seo_url','state.seo_url as state_seo_url','location.pincode','location.postoffice_name','location.seo_url as location_seo_url','district.seo_description','district.seo_title')
        ->join('state','state.state_code','=','district.state_code')
        ->join('location','location.district_code','=','district.district_code')
        ->where('district.seo_url', 'like', '%'.$request->path().'%');
        $total_count = $query->count();
        $records = $query->limit($limit)->offset($offset)->get();
        $html = '';
        $district_details = District::select('district.seo_title','district.seo_description','state.seo_url as state_seo_url')
        ->join('state','district.state_code','=','state.state_code')
        ->where('district.district', 'like', '%'.$district.'%')
        ->first();
        if(!empty($records) && count($records) > 0) {
            foreach ($records as $record) {
                $pincode = URL::to('pincode').'/'. $record->pincode;
                $postoffice_name = URL::to('/').$record->location_seo_url;
                $state_url = URL::to('/') . $record->state_seo_url;
                $district_url = URL::to('/').$record->district_seo_url;
                $html .= '<tr>
                <td><a href="'.$postoffice_name.'">' . $record->postoffice_name . '</a></td>
                <td><a href="'.$pincode.'">' . $record->pincode . '</a></td>
                <td><a href="'.$district_url.'">' . $record->district_name . '</td>
                <td><a href="'.$state_url.'">' . $record->state_name . '</a></td>
                </tr>';
            }
        }   else {
            $html .= '<tr><td colspan="4">No Records Available</td></tr>';
        }    

        if ($request->ajax()) {
           return $html;
        }
        $totalPageNumber = (int) ceil($total_count / $limit);
        return view('district', compact('records', 'totalPageNumber','district','state','district_details'));
     
    }


     public function locationList($state,$district,$postoffice_name,Request $request)
    {
        $limit = 30;
        $offset = isset($request->page) ? $request->page : 0;
        $pincode = isset($request->pincode) ? $request->pincode : '';
        $location_details = Location::select('location.seo_title','location.seo_description','state.seo_url as state_seo_url','district.seo_url as district_seo_url')
        ->join('state','location.state_code','=','state.state_code')
        ->join('district','district.district_code','=','location.district_code')
        ->where('postoffice_name', 'like', '%'.$postoffice_name.'%')
        ->first();
        
        $query = Location::select('district.district as district_name','state.state as state_name','state.state_code','state.seo_url as state_seo_url','district.district','district.seo_url as district_seo_url','location.pincode','location.postoffice_name','state.state','location.seo_url as location_seo_url','location.seo_description','location.seo_title')
        ->join('state','location.state_code','=','state.state_code')
        ->join('district','district.district_code','=','location.district_code')
        ->where('location.seo_url', 'like', '%'.$request->path().'%');
         $total_count = $query->count();
        if(empty($postoffice_name)) {
            $query->limit($limit)->offset($offset);
        }
        $records = $query->get();
        $html = '';
        if(!empty($records) && count($records) > 0) {

            foreach ($records as $record) {
                $pincode_url = URL::to('pincode').'/'. $record->pincode;
                $state_url = URL::to('/') . $record->state_seo_url;
                $district_url = URL::to('/').$record->district_seo_url;
                $postoffice = URL::to('/').$record->location_seo_url;
                $html .= '<tr>
                <td><a href="'.$postoffice.'">' . $record->postoffice_name . '</a></td>
                <td><a href="'.$pincode_url.'">' . $record->pincode . '</a></td>
                <td><a href="'.$district_url.'">' . $record->district_name . '</a></td>
                <td><a href="'.$state_url.'">' . $record->state_name . '</a></td>
                </tr>';
            } 
        }   else {
            $html .= '<tr><td colspan="4">No Records Available</td></tr>';
        }
       
        if ($request->ajax()) {
          
            return $html;
        }
        $totalPageNumber = (int) ceil($total_count / $limit);
        return view('location', compact('records', 'totalPageNumber','postoffice_name','pincode','state','district','location_details'));
    }

    public function allLocationList(Request $request)
    {
        $limit = 30;
        $offset = isset($request->page) ? $request->page : 0;
        $query = Location::select('district.district as district_name','state.state as state_name','state.state_code','state.seo_url as state_seo_url','district.district','district.seo_url as district_seo_url','location.pincode','location.postoffice_name','state.state','location.seo_url as location_seo_url','location.seo_description','location.seo_title')
        ->join('state','location.state_code','=','state.state_code')
        ->join('district','district.district_code','=','location.district_code');
        $total_count = $query->count();
        $query = $query->limit($limit)->offset($offset);
        $records = $query->get();
        $html = '';
        if(!empty($records) && count($records) > 0) {

            foreach ($records as $record) {
                $pincode_url = URL::to('pincode').'/'. $record->pincode;
                $state_url = URL::to('/') . $record->state_seo_url;
                $district_url = URL::to('/').$record->district_seo_url;
                $postoffice = URL::to('/').$record->location_seo_url;
                $html .= '<tr>
                <td><a href="'.$postoffice.'">' . $record->postoffice_name . '</a></td>
                <td><a href="'.$pincode_url.'">' . $record->pincode . '</a></td>
                <td><a href="'.$district_url.'">' . $record->district_name . '</a></td>
                <td><a href="'.$state_url.'">' . $record->state_name . '</a></td>
                </tr>';
            } 
        }   else {
            $html .= '<tr><td colspan="4">No Records Available</td></tr>';
        }
       
        if ($request->ajax()) {
          
            return $html;
        }
        $totalPageNumber = (int) ceil($total_count / $limit);
        return view('location', compact('records', 'totalPageNumber'));
    }

    public function pincodeDetails($pincode)
    {
        $records = Location::select('district.district as district_name','state.state as state_name','state.state_code','state.seo_url as state_seo_url','district.district','district.seo_url as district_seo_url','location.pincode','location.postoffice_name','state.state','location.seo_url as location_seo_url','location.seo_description','location.seo_title')
        ->join('state','location.state_code','=','state.state_code')
        ->join('district','district.district_code','=','location.district_code')
        ->where('location.pincode', $pincode)->get();
       $pincode_details = Location::select('pincode_seo_title','pincode_seo_description','pincode')->where('pincode', 'like', '%'.$pincode.'%')->first();
        return view('pincode', compact('records','pincode','pincode_details'));
    }

    public function allDistrictList(Request $request)
    {   
        $limit = 30;
        $offset = isset($request->page) ? $request->page : 0;
        $query = District::select('district.district as district_name','state.state as state_name','district.seo_url as district_seo_url','state.seo_url as state_seo_url','location.pincode','location.postoffice_name','location.seo_url as location_seo_url','district.seo_description','district.seo_title')
        ->join('state','state.state_code','=','district.state_code')
        ->join('location','location.district_code','=','district.district_code');
        $total_count = $query->count();
        $records = $query->limit($limit)->offset($offset)->get();
        $html = '';
        if(!empty($records) && count($records) > 0) {
            foreach ($records as $record) {
                $pincode = URL::to('pincode').'/'. $record->pincode;
                $postoffice_name = URL::to('/').$record->location_seo_url;
                $state_url = URL::to('/') . $record->state_seo_url;
                $district_url = URL::to('/').$record->district_seo_url;
                $html .= '<tr>
                <td><a href="'.$postoffice_name.'">' . $record->postoffice_name . '</a></td>
                <td><a href="'.$pincode.'">' . $record->pincode . '</a></td>
                <td><a href="'.$district_url.'">' . $record->district_name . '</td>
                <td><a href="'.$state_url.'">' . $record->state_name . '</a></td>
                </tr>';
            }
        }   else {
            $html .= '<tr><td colspan="4">No Records Available</td></tr>';
        }    

        if ($request->ajax()) {
           return $html;
        }
        $totalPageNumber = (int) ceil($total_count / $limit);
        return view('district', compact('records', 'totalPageNumber'));
     
    }
}
