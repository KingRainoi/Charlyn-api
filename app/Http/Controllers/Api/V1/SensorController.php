<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Sensor;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SensorResource;
use Illuminate\Support\Facades\Http;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la solicitud a la API externa de PRTG
        // $response = Http::withoutVerifying()->get('https://127.0.0.1/api/table.json?content=sensors&columns=sensor&username=root&password=prtgadmin');
        $response = Http::withoutVerifying()->get('https://127.0.0.1/api/table.json?content=sensors&columns=device,sensor,status&username=root&password=prtgadmin');

        // Verificar si la solicitud fue exitosa (código de respuesta 200)
        if ($response->successful()) {
            // Obtener los datos de la respuesta de la API externa y devolverlos como JSON
            return response()->json($response->json());
        } else {
            // Manejar el caso en que la solicitud a la API externa de PRTG falla
            return response()->json(['message' => 'Error al obtener datos de la API externa de PRTG'], 500);
        }
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
        $response = Http::withoutVerifying()->get('https://127.0.0.1/api/table.json?content=sensors&columns=device,sensor,status&username=root&password=prtgadmin');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            dd('Error en la solicitud a la API externa: ' . $response->status());
        }
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
