@extends('layouts.app')
@section('content')
<h4>{{ $item->exists ? 'Edit' : 'Tambah' }} Data Service</h4>
<form method="POST" action="{{ $item->exists ? route('data-service.update', $item) : route('data-service.store') }}" class="card card-body">
    @csrf @if($item->exists) @method('PUT') @endif
    <div class="mb-3">
        <label class="form-label">Id Servis Pelanggan</label>
        <select name="id_servis" id="id_servis" class="form-select" required>
            <option value="">-- Pilih Id Servis --</option>
            @foreach($servis as $s)
                <option value="{{ $s->id_servis }}" data-keluhan="{{ $s->keluhan }}"
                    {{ old('id_servis', $item->id_servis) == $s->id_servis ? 'selected' : '' }}>
                    {{ $s->id_servis }} - {{ $s->no_plat }} ({{ $s->pelanggan->nama_lengkap ?? '-' }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Keluhan Kendaraan (otomatis)</label>
        <textarea id="keluhan" class="form-control" rows="2" readonly></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Estimasi Service</label>
        <input type="text" name="estimasi_service" class="form-control" placeholder="contoh: 2 hari"
               value="{{ old('estimasi_service', $item->estimasi_service) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Mekanik</label>
        <input type="text" name="nama_mekanik" class="form-control" value="{{ old('nama_mekanik', $item->nama_mekanik) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Sparepart Pengganti</label>
        <input type="text" name="sparepart_pengganti" class="form-control" value="{{ old('sparepart_pengganti', $item->sparepart_pengganti) }}" required>
    </div>
    <div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('data-service.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</form>

<script>
    const sel = document.getElementById('id_servis');
    const kel = document.getElementById('keluhan');
    function isiKeluhan() {
        const opt = sel.options[sel.selectedIndex];
        kel.value = opt && opt.dataset.keluhan ? opt.dataset.keluhan : '';
    }
    sel.addEventListener('change', isiKeluhan);
    isiKeluhan();
</script>
@endsection