<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranApiController extends Controller
{
    private function rules(): array
    {
        return [
            'id_servis'        => 'required|exists:daftar_services,id_servis',
            'jumlah_biaya'     => 'required|integer|min:0',
            'jenis_pembayaran' => ['required', Rule::in(['Tunai', 'Non Tunai'])],
            'keterangan'       => 'nullable|string',
        ];
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => Pembayaran::with('daftarService')->get()]);
    }

    public function show($id)
    {
        return response()->json(['success' => true, 'data' => Pembayaran::with('daftarService')->findOrFail($id)]);
    }

    public function store(Request $request)
    {
        $item = Pembayaran::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Pembayaran berhasil disimpan', 'data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = Pembayaran::findOrFail($id);
        $item->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Pembayaran berhasil diubah', 'data' => $item]);
    }

    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dihapus']);
    }
}