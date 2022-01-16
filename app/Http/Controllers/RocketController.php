<?php

namespace App\Http\Controllers;

use App\Models\Rocket;

use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RocketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rockets = Rocket::with("manufacturer")->orderBy("human_rated", "desc")->get()->groupBy("manufacturer.country.prefix_rockets");
        $countries = Country::with("manufacturers")->get();
        $manufacturers = Manufacturer::all();
        return view('rakety', ["rockets" => $rockets, "countries" => $countries, "manufacturers" => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'manufacturer_id' => ['required', 'integer','min:0'],
            'human_rated' => ['required', 'integer', 'min:0', 'max:1'],
            'payload' => ['required', 'numeric', 'max:999.0', 'min:0.0'],
            'height' => ['required', 'numeric', 'max:999.0', 'min:0.0'],
            'file' => ['required', 'mimes:jpeg,bmp,png,jpg']
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $path = $request->file('file')->store(
            'rocketImages', ["disk"=>"public"]
        );
        $data = $request->all();
        $data["image"]=$path;
        $rocket = Rocket::create($data);
        return redirect('/rakety');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rocket $rocket)
    {
        $validator = Validator::make($request->all(), [
            'rocket_edit_name' => ['required', 'string', 'max:20'],
            'rocket_edit_manufacturer_id' => ['required', 'integer','min:0'],
            'rocket_edit_human_rated' => ['required', 'integer', 'min:0', 'max:1'],
            'rocket_edit_payload' => ['required', 'numeric', 'max:999.0', 'min:0.0'],
            'rocket_edit_height' => ['required', 'numeric', 'max:999.0', 'min:0.0'],
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $rocket->name = $request->rocket_edit_name;
        $rocket->manufacturer_id = $request->rocket_edit_manufacturer_id;
        $rocket->human_rated = $request->rocket_edit_human_rated;
        $rocket->payload = $request->rocket_edit_payload;
        $rocket->height = $request->rocket_edit_height;
        $rocket->save();
        return redirect('/rakety');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('rockets')->where('id', $id)->delete();
        return redirect('/rakety');
    }
}
