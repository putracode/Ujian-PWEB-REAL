@extends('layout')



@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tambah Kategori</h4>
                        <a href="/kategori/create" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Kategori
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="display table table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($kategori as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td>
                                            <div class="form-button-action d-flex gap-1">
                                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>

                                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
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
