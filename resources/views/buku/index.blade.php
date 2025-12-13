@extends('layout')



@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Sistem Perpustakaan</h3>
            <h6 class="op-7 mb-2">Manajemen Pengelola Buku</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/buku/list" class="btn btn-label-info btn-round me-2">Lihat List</a>
            {{-- <a href="#" class="btn btn-primary btn-round">Add Customer</a> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tabel Buku</h4>
                        <a href="/buku/create" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Buku
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="display table table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Cover</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Cover</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($buku as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->penulis }}</td>
                                        <td>{{ $item->penerbit }}</td>
                                        <td>{{ $item->tahun_terbit }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            @if ($item->cover_image)
                                                <img src="{{ asset('storage/' . $item->cover_image) }}" alt="Cover"
                                                    width="50" class="img-thumbnail">
                                            @else
                                                <span class="badge badge-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action d-flex gap-1">
                                                <a href="{{ route('buku.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                                    title="Edit Buku">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>

                                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip" title="Hapus Buku">
                                                        <i class="fa fa-times text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.7/css/responsive.dataTables.min.css">
@endsection



@section('js')
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#table").DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
