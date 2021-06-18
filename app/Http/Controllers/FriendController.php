<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller {

    private const nullPointer = "Null Pointer Exception";
    private const dataIncorrect = "Algunos datos no se han procesado correctamente";

    /**
     * Método inicial con el que obtenemos todos los datos de forma descendente (con el último usuario agregado).
     *
     * @return JsonResponse Salida para la base de datos.
     */
    public function index(): JsonResponse {
        $friend = DB::select(DB::raw("SELECT f.*, (SELECT COUNT(*) FROM `call` c WHERE c.idFriend = f.id) AS times FROM `friend` f"));

        try {
            return response()->json($friend);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function store(Request $request): JsonResponse {
        if (isset($request['times'])) {
            unset($request['times']);
        }

        $friend = Friend::create($request->all());

        if ($friend === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        try {
            return response()->json(['friend' => $friend]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function show($id): JsonResponse {
        //$friend = Friend::find($id);
        $friend = DB::select(DB::raw("SELECT f.*, (SELECT COUNT(*) FROM `call` c WHERE c.idFriend = f.id) AS times FROM `friend` f WHERE f.id = '$id'"));

        if (!$friend) {
            return response()->json(['error' => self::nullPointer]);
        }

        try {
            return response()->json($friend);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function update(Request $request, $id): JsonResponse {
        $friend = Friend::find($id);

        if ($friend === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        $result = $friend->update($request->all());

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
        $result = Friend::destroy($id);

        if ($result === null) {
            return response()->json(['error' => self::nullPointer]);
        }

        try {
            return response()->json(['result' => $result]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }

    public function destroyAll(): JsonResponse {
        $friend = DB::select(DB::raw("DELETE FROM `friend`"));

        try {
            return response()->json($friend);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception]);
        }
    }
}
