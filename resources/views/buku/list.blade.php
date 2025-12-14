@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0">Katalog Buku</h3>
            <div>
                <a href="{{ route('buku.index') }}" class="btn btn-secondary btn-round me-2">
                    <i class="fa fa-list"></i> Tabel View
                </a>
                <a href="{{ route('buku.create') }}" class="btn btn-primary btn-round">
                    <i class="fa fa-plus"></i> Tambah Buku
                </a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-5">
            @forelse($buku as $item)
                <div class="col">
                    <div class="card h-80 shadow-md card-hover border-0">
                        <div class="position-relative overflow-hidden rounded-top">
                            @if ($item->cover_image)
                                <img src="{{ asset('storage/' . $item->cover_image) }}" class="card-img-top book-cover"
                                    alt="{{ $item->judul }}">
                            @else
                                <div
                                    class="card-img-top book-cover d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="fa fa-book fa-4x"></i>
                                </div>
                            @endif

                            <span class="position-absolute top-0 end-0 badge bg-dark m-2 shadow-sm">
                                <td>{{ $item->kategori->nama_kategori }}</td>
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column pb-2">

                            <h5 class="card-title fw-bold text-truncate" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </h5>

                            <h6 class="card-subtitle mb-3 text-muted small">
                                <i class="fa fa-user-edit me-1"></i> {{ Str::limit($item->penulis, 15, '...') }}
                            </h6>

                            <p class="card-text small text-muted flex-grow-1">
                                {{ Str::limit($item->deskripsi, 40, '...') }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                <small class="text-muted">
                                    <i class="fa fa-calendar-alt me-1"></i> {{ $item->tahun_terbit }}
                                </small>

                                @if ($item->stok > 5)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        Stok: {{ $item->stok }}
                                    </span>
                                @elseif($item->stok > 0)
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                        Stok Menipis: {{ $item->stok }}
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                        Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <h4><i class="fa fa-info-circle mb-3 d-block fa-2x"></i></h4>
                        Belum ada data buku yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('css')
    <style>
        .book-cover {
            height: 200px;
            width: 100%;
            object-fit: cover;
            object-position: center;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .bg-success-subtle {
            background-color: #d1e7dd;
        }

        .bg-warning-subtle {
            background-color: #fff3cd;
        }

        .bg-danger-subtle {
            background-color: #f8d7da;
        }
    </style>
@endsection
