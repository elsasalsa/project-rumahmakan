@extends('layouts.template')

@section('content')

<div class="main" style="margin-top: 120px;">
<a href="{{ route('produk.create') }}"><button class="btn btn-secondary">Tambah Produk</button></a>
    <table class="table table-hover" style="margin: 10px 0 5px;">
        <thead>
            <tr class="table-success table-bordered table-striped">
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga Produk</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($produks as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->produk }}</td>
                <td>{{ $item->harga }}</td>
                <td class="d-flex">
                    <a href="{{ route('produk.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#edit-stock">
                        Hapus
                      </button>
                </td>
            </tr>
            <div class="modal" tabindex="-1" id="edit-stock">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Yakin ingin menghapus data ini? </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <form action="{{ route('produk.delete', $item['id']) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
