<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\KategoriBerita;
use App\Models\KategoriReport;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexReport()
    {
        $kategori_report = KategoriReport::all();
        return response()->json($kategori_report, 200);
    }

    public function indexBerita()
    {
        $kategori_berita = KategoriBerita::all();
        return response()->json($kategori_berita, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeReport(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50', // Ensuring 'name' is required
        ]);

        // If validation fails, return the errors with status 422
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori_report = KategoriReport::create([
            'name' => $request->name,
        ]);
        return response()->json($kategori_report, 201);
    }

    public function storeBerita(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $fotoPath = str_replace('public/', 'storage/', $foto->store('public/kategoriberita'));

        $kategori_berita = KategoriBerita::create([
            'name' => $request->name,
            'foto' => $fotoPath
        ]);
        return response()->json($kategori_berita, 201);
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