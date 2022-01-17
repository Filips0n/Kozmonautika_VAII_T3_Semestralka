<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Spaceport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SpaceportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spaceports = Spaceport::with(["country", "spaceportImages"])->get()->sortBy('country_id')->groupBy("country.agency_name");
        $countries = Country::with("spaceports")->get();
        return view('kozmodromy', ["spaceports" => $spaceports, "countries" => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'country_id' => ['required', 'integer','min:0'],
            'launches' => ['required', 'integer', 'min:0'],
            'active_from' => ['required', 'integer', 'min:1900', 'max:2022'],
            'latitude'=> ['required', 'numeric', 'min:-90', 'max:90'],
            'longitude' => ['required', 'numeric', 'min:-180', 'max:180']
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();
        $spaceport = Spaceport::create($data);
        return redirect('/kozmodromy');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spaceport $spaceport)
    {
        $validator = Validator::make($request->all(), [
            'spaceport_edit_name' => ['required', 'string', 'max:100'],
            'spaceport_edit_country_id' => ['required', 'integer','min:0'],
            'spaceport_edit_launches' => ['required', 'integer', 'min:0'],
            'spaceport_edit_active_from' => ['required', 'integer', 'min:0'],
            'spaceport_edit_latitude'=> ['required', 'numeric', 'min:-90', 'max:90'],
            'spaceport_edit_longitude' => ['required', 'numeric', 'min:-180', 'max:180']
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $spaceport->name = $request->spaceport_edit_name;
        $spaceport->country_id = $request->spaceport_edit_country_id;
        $spaceport->launches = $request->spaceport_edit_launches;
        $spaceport->active_from = $request->spaceport_edit_active_from;
        $spaceport->latitude = $request->spaceport_edit_latitude;
        $spaceport->longitude = $request->spaceport_edit_longitude;
        $spaceport->save();
        return redirect('/kozmodromy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('spaceports')->where('id', $id)->delete();
        return redirect('/kozmodromy');
    }
}
