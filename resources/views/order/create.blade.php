@extends('layouts.template')

@section('content')
    <form action="{{ route('order.store')}}" method="POST" class="card p-4 mt-5">
        @csrf
       
        <div class="mb-3 row">
            <label for="name_customer" class="col-sm-2 col-form-label @error('name_customer') is-invalid @enderror">Nama
                Pembeli :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name_customer" name="name_customer"
                    value="{{ old('name_customer') }}">
                @error('name_customer')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="produks" class="col-sm-2 col-form-label @error('produks') is-invalid @enderror">PRODUK
                :</label>
            <div class="col-sm-10">
                @error('produks')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                {{-- name dengan [] agar semua value dari input/select yg name nya produks bisa diambil semuanya --}}
                <select name="produks[]" class="form-control">
                    <option disabled hidden selected>Pesanan 1</option>
                    @foreach ($produks as $item)
                        <option value="{{ $item['id'] }}">{{ $item['produk'] }}</option>
                    @endforeach
                </select>
                {{-- div kosong buat nanti disimpen html dari js --}}
                <div id="wrap-produks"></div>
                <p class="text-primary mt-3" style="cursor: pointer" onclick="addSelect()">+ tambah pesanan</p>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
    </form>
    @endsection
    {{-- nentuin pesanan yg ke brp --}}
    @push('script')
    <script>
        let no = 2;
        // kalo ditaro didalam script jadinya di definisikan ulang
        function addSelect() {
            //html yg akan ditambahkan ketika diklik
            //$(no) manggil variable no
            let el = `<select name="produks[]" class="form-control mt-3">
                <option disabled hidden selected>Pesanan ${no}</option>
                @foreach ($produks as $item)
                    <option value="{{ $item['id'] }}">{{ $item['produk'] }}</option>
                @endforeach
                </select>`;
                //dgn jquery, pada el dgn id wrap-produks, ditambah html baru dari variable el & disimpan disebelum penurtup tag wrap-produks nya (append)
                // $() -> js
                // # -> id
                $("#wrap-produks").append(el);
                // .append -> menambah
                // .html -> mengubah
                // variabel no di increments, agar berubah menjadi ditambah 1 tiap ada penambahan el html select
                no++;
        }
    </script>



    
{{-- <div class="mb-3 row">
    <label for="produk" class="col-sm-2 col-form-label @error('produk') is-invalid @enderror">Produk :</label>
    <div class="col-sm-10">
        <select class="form-select" name="produk" aria-label="Default select example">
            <option selected hidden disabled>Pilih produk</option>
            @foreach ($produks as $item)
                <option value="{{ $item['id'] }}">{{ $item['produk'] }}</option>
            @endforeach
        </select>
        @error('produk')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div> --}}
