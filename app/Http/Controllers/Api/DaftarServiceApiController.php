<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DaftarServiceApiController extends Controller
{
    private function rules(): array
{
    return [
        'id_servis' => 'required|string|unique:daftar_services,id_servis',
        'kendaraan_id' => 'required|exists:kendaraans,id',
        'pelanggan_id' => 'required|exists:pelanggans,id',
        'keluhan_kendaraan' => 'required|string',
        'tanggal_servis' => 'required|date',
    ];

    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => DaftarService::with(['kendaraan', 'pelanggan'])->get()]);
    }

    public function show($id)
    {
        return response()->json(['success' => true, 'data' => DaftarService::with(['kendaraan', 'pelanggan'])->findOrFail($id)]);
    }

    public function store(Request $request)
    {
        $item = DaftarService::create($request->validate($this->rules()));
        $item->load(['kendaraan', 'pelanggan']);
        return response()->json(['success' => true, 'message' => 'Daftar service berhasil disimpan', 'data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = DaftarService::findOrFail($id);
        $item->update($request->validate($this->rules()));
        $item->load(['kendaraan', 'pelanggan']);
        return response()->json(['success' => true, 'message' => 'Daftar service berhasil diubah', 'data' => $item]);
    }

    public function destroy($id)
    {
        DaftarService::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Daftar service berhasil dihapus']);
    }
}