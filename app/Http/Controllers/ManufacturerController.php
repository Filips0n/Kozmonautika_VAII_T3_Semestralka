<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::with("country")->get()->sortBy("country_id");
        return view('vyrobcovia', ["manufacturers" => $manufacturers]);
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
            'name' => ['required', 'string', 'max:50'],
            'country_id' => ['required', 'integer','min:0'],
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();
        $manufacturer = Manufacturer::create($data);
        return redirect('/vyrobcovia');
    }

         /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $validator = Validator::make($request->all(), [
            'manufacturer_edit_name' => ['required', 'string', 'max:50'],
            'manufacturer_edit_country_id' => ['required', 'integer','min:0'],
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $manufacturer->name = $request->manufacturer_edit_name;
        $manufacturer->country_id = $request->manufacturer_edit_country_id;
        $manufacturer->save();
        return redirect('/vyrobcovia');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('manufacturers')->where('id', $id)->delete();
        return redirect('/vyrobcovia');
    }
}
