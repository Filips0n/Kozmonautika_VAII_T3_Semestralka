<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        return view('krajiny');
    }

    function fetchCountries(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('countries')->orderBy('id','asc')->get();
            echo json_encode($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request)
    {
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50'],
                'agency_name' => ['required', 'string', 'max:50'],
                'prefix_rockets' => ['required', 'string', 'max:50'],
            ]);

            if ($validator->fails()) {
                dd($validator->errors());
                return redirect('post/create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $data = $request->all();
            $country = Country::create($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name => $request->column_value
            );
            DB::table('countries')->where('id', $request->id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy(Request $request)
    {
        if($request->ajax())
        {
            DB::table('countries')->where('id', $request->id)->delete();
        }
    }
}
