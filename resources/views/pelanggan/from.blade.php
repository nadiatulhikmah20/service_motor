@extends('layouts.app')
@section('content')
<h4>{{ $item->exists ? 'Edit' : 'Tambah' }} Pelanggan</h4>
<form method="POST" action="{{ $item->exists ? route('pelanggan.update', $item) : route('pelanggan.store') }}" class="card card-body">
    @csrf @if($item->exists) @method('PUT') @endif
    <div class="mb-3">
        <label class="form-label">Id Pelanggan</label>
        <input type="text" class="form-control" value="{{ $item->id_pelanggan ?? '(otomatis)' }}" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $item->no_hp) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat Pelanggan</label>
        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $item->alamat) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Pekerjaan</label>
        <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $item->pekerjaan) }}" required>
    </div>
    <div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</form>
@endsection