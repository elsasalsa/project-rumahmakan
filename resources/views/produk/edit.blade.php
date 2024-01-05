@extends('layouts.template')

@section('content')
<form action="{{ route('produk.update',  $products['id']) }}" class="card p-5" style="margin-top: 100px;" method="POST">
    {{-- kalau ada error validasi, akan ditampilkan disini--}}
    {{-- @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif --}}
    {{-- kalau kedetksi ada sith session namanya 'success' pas masuk ke hal ini, msg nya bakal dimunculin disini--}}
    @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    {{-- token syarat kirim data (agar sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
    @csrf
    @method('PATCH')
    <div class="mb-3 row">
        <label for="produk" class="col-sm-2 col-form-label @error('produk') is-invalid @enderror">Nama Produk :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="produk" name="produk" value="{{ $products['produk'] }}">
          @error('produk')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="mb-3 row">
        <label for="harga" class="col-sm-2 col-form-label @error('harga') is-invalid @enderror">Total Harga</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="harga" name="harga" value="{{ $products['harga'] }}">
          @error('harga')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      
      <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection

    {{-- <div class="main" style="margin-top: 100px; ">
        <select class="form-select" aria-label="Default select example">
            <option selected hidden disabled>Open this select menu</option>
            @foreach ($produks as $item)
                <option value="{{ $item['id'] }}">{{ $item['produk'] }}</option>
            @endforeach
        </select>
    </div> --}}

