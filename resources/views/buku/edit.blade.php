@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Buku</div>
                </div>

                <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul Buku</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" placeholder="Masukkan judul buku">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                                        id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" placeholder="Nama penulis">
                                    @error('penulis')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                                        id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" placeholder="Nama penerbit">
                                    @error('penerbit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun_terbit">Tahun Terbit</label>
                                    <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                                        id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" placeholder="Contoh: 2025">
                                    @error('tahun_terbit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                        id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" placeholder="Jumlah stok">
                                    @error('stok')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                                        id="kategori" name="kategori" value="{{ old('kategori', $buku->kategori) }}" placeholder="Contoh: Novel, Sains">
                                    @error('kategori')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                id="deskripsi" name="deskripsi" rows="5" placeholder="Deskripsi singkat buku">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cover_image" class="d-block">Cover Image</label>
                            
                            @if($buku->cover_image)
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-2">Gambar saat ini:</small>
                                    <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Current Cover" style="max-height: 150px; border-radius: 8px; border: 1px solid #ddd; padding: 5px;">
                                </div>
                            @endif

                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            
                            <input type="file" 
                                   class="filepond mt-2"
                                   name="cover_image" 
                                   id="cover_image"
                                   accept="image/png, image/jpeg, image/jpg, image/gif"
                            />

                            @error('cover_image')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/buku" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType
        );

        const inputElement = document.querySelector('#cover_image');

        const pond = FilePond.create(inputElement, {
            storeAsFile: true,
            labelIdle: 'Seret & Lepas gambar baru di sini atau <span class="filepond--label-action">Cari</span>',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'],
            labelFileTypeNotAllowed: 'File tipe tidak valid',
            fileValidateTypeLabelExpectedTypes: 'Hanya gambar yang diperbolehkan',
            imagePreviewHeight: 170, 
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
        });
    </script>
@endsection