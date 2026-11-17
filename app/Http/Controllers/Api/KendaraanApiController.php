<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanApiController extends Controller
{
   private function rules(): array
{
    return [
        'jenis_kendaraan' => [
            'required',
            Rule::in(['Matic', 'Manual Transmisi'])
        ],
        'no_stnk' => 'required|string|max:30',
        'tahun_pembuatan' => 'required|integer|min:1950|max:' . (date('Y') + 1),
        'nama_pemilik' => 'required|string|max:100',
        'warna' => 'required|string|max:30',
    ];
}
    public function index()
    {
        return response()->json(['success' => true, 'data' => Kendaraan::all()]);
    }

    public function show($id)
    {
        return response()->json(['success' => true, 'data' => Kendaraan::findOrFail($id)]);
    }

    public function store(Request $request)
    {
        $rules = array_merge(['no_plat' => 'required|string|max:15|unique:kendaraans,no_plat'], $this->rules());
        $item = Kendaraan::create($request->validate($rules));
        return response()->json(['success' => true, 'message' => 'Data kendaraan berhasil disimpan', 'data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = Kendaraan::findOrFail($id);
        $item->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data kendaraan berhasil diubah', 'data' => $item]);
    }

    public function destroy($id)
    {
        Kendaraan::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Data kendaraan berhasil dihapus']);
    }
}