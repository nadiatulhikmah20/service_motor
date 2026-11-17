<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceApiController extends Controller
{
    private function rules(): array
    {
        return [
            'id_servis'           => 'required|exists:daftar_services,id_servis',
            'estimasi_service'    => 'required|string|max:100',
            'nama_mekanik'        => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ];
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => DataService::with('daftarService')->get()]);
    }

    public function show($id)
    {
        return response()->json(['success' => true, 'data' => DataService::with('daftarService')->findOrFail($id)]);
    }

    public function store(Request $request)
    {
        $item = DataService::create($request->validate($this->rules()));
        $item->load('daftarService');
        return response()->json(['success' => true, 'message' => 'Data service berhasil disimpan', 'data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = DataService::findOrFail($id);
        $item->update($request->validate($this->rules()));
        $item->load('daftarService');
        return response()->json(['success' => true, 'message' => 'Data service berhasil diubah', 'data' => $item]);
    }

    public function destroy($id)
    {
        DataService::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Data service berhasil dihapus']);
    }
}