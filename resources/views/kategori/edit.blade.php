@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Kategori</div>
                </div>

                <form action="/kategori/{{ $kategori->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                placeholder="Masukkan Kategori">
                            @error('nama_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="/kateogri" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
