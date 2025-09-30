<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class UserApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('id', 'asc')->get();
        return response()->json(
            // 'status' => true,
            // 'message' => 'data ditemukan',
            // 'data' => 
            $data,
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            // Tambahkan aturan validasi lain sesuai kebutuhan
        ]);

        $yom = hash('sha256', $request->password);
        $cekdata = User::where('username', $request->username)->where('password', $yom)->get();

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
        //untuk post mengubah data API
        // $post = Post::create($request->all());

        elseif ($cekdata->isEmpty()) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Data tidak ditemukan',
            ], 404); // 404 Not Found
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $cekdata
            ], 201); // 201 Created
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
