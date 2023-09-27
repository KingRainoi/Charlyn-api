<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Sensor;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SensorController extends Controller
{
    /**
     * Realizar la solicitud a la API externa de PRTG y manejar la respuesta.
     */
    private function makeApiSensorRequest()
    {
        $response = Http::withoutVerifying()->get('https://127.0.0.1/api/table.json?content=sensors&columns=device,sensor,status&username=root&password=prtgadmin');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['message' => 'Error al obtener datos de la API externa de PRTG'], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->makeApiSensorRequest();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSensorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sensor $sensor)
    {
        return $this->makeApiSensorRequest();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensorRequest $request, Sensor $sensor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sensor $sensor)
    {
        //
    }
}
