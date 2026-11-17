<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganApiController extends Controller
{
    private function rules(): array
    {
        return [
              'id_pelanggan'     => 'required|string|max:255',
            'nama_lengkap'     => 'required|string|max:255',
            'no_hp'            => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan'        => 'required|string|max:255',
        ];
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => Pelanggan::all()]);
    }

    public function show($id)
    {
        return response()->json(['success' => true, 'data' => Pelanggan::findOrFail($id)]);
    }

    public function store(Request $request)
    {
        $item = Pelanggan::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data pelanggan berhasil disimpan', 'data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = Pelanggan::findOrFail($id);
        $item->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data pelanggan berhasil diubah', 'data' => $item]);
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Data pelanggan berhasil dihapus']);
    }
}