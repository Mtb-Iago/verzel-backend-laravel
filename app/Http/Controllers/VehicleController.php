<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicles::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)
    {
        $request->authorize();
        return Vehicles::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  Vehicles  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Vehicles $vehicle)
    {
        return $vehicle->findOrFail($request->id);
    }

    public function search($name)
    {
        return Vehicles::where('name', 'like', '%'.$name.'%')->get();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Vehicles  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicles $vehicle)
    {
        return $vehicle->findOrFail($request->id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Vehicles::destroy($id);

        return json_encode(response($response ? "Deletado com Sucesso" : "Veículo não encontrado"));
    }
}
