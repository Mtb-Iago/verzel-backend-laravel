<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Vehicles;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = Vehicles::all();
        $vehicle->map(function ($vehicle) {
            $vehicle->photo = Storage::url($vehicle->photo);
            return $vehicle;
        });

        return $vehicle;
        // return response()->json(["status" => false, "message" => "Veículo não encontrado"], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)
    {

        try {
            $request->authorize();
            $data = $request->all();
            if ($request->photo) {
                $data['photo'] = $data['photo']->store('vehicles');
            }
            $res = Vehicles::create($data);
            return response()->json(["status" => false, "message" => "Veículo cadastrado com sucesso", "data" => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => false, "message" => "Erro ao cadastrar veículo"], 401);
        }
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
        return Vehicles::where('name', 'like', '%' . $name . '%')->get();
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
        try {
            $vehicle = $vehicle->findOrFail($request->id);
            $data = $request->all();
            if ($data['photo']) {
                if ($vehicle['photo'] && Storage::exists($vehicle['photo'])) {
                    Storage::delete($vehicle['photo']);
                }
                $data['photo'] = $request->photo->store('vehicles');
            }
            return $vehicle->update($data);
        } catch (\Throwable $th) {
            return response()->json(["status" => false, "message" => "{$th->getMessage()}"], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Vehicles $vehicle)
    {
        try {
            $vehicle = $vehicle->findOrFail($id);

            if ($vehicle['photo'] && Storage::exists($vehicle['photo'])) {
                Storage::delete($vehicle['photo']);
            }

            Vehicles::destroy($id);
            return response()->json(["status" => true, "message" => "Deletado com Sucesso"]);
        } catch (\Throwable $th) {
            return response()->json(["status" => false, "message" => "Veículo não encontrado"], 401);
        }
    }
}
