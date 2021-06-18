<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallController extends Controller {

    private const nullPointer = "Null Pointer Exception";
    private const dataIncorrect = "Algunos datos no se han procesado correctamente";

    /**
     * Método inicial con el que obtenemos todos los datos de forma descendente (con el último usuario agregado).
     *
     * @return JsonResponse Salida para la base de datos.
     */
    public function index(): JsonResponse {
        $call = DB::table('call')->select('call.*')->orderByRaw('id DESC')->get();

        try {
            return response()->json($call);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function store(Request $request): JsonResponse {
        $call = Call::create($request->all());

        if ($call === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        try {
            return response()->json(['call' => $call->id]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function show($id): JsonResponse {
        $call = Call::find($id);

        if ($call === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        try {
            return response()->json($call);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function update(Request $request, $id): JsonResponse {
        $call = Call::find($id);

        if ($call === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        $result = $call->update($request->all());

        if ($result === false) {
            return response()->json(['error' => self::dataIncorrect]);
        }

        try {
            return response()->json(['result' => true]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function destroy($id): JsonResponse {
        $result = Call::destroy($id);

        if ($result === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        try {
            return response()->json(['result' => $result]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }
}
