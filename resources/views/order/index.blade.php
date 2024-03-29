@extends('layouts.template')

@section('content')

    <div class="my-5 d-flex justify-content-end" >
        
        <form action="{{ route('order.index') }}" style="margin-top:70px;" method="GET" >
            
            <input type="date" name="query" placeholder="Cari...">
            <button type="submit" class="btn btn-info" >Cari</button>
            <a href="{{ route('order.index') }}" class="btn btn-secondary">Clear</a>  
            <a href="{{route('order.api')}}"><button class="btn btn-danger">Cek API</button></a>
        </form>
        
    </div>
    <table class="table table-stripped table-bordered table-hover">
        <thead>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Produk</th>
            <th>Total Price</th>
            <th>Tanggal Pembelian</th>
            
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($orders as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->name_customer }}</td>
                <td>
                    <ol>
                    @foreach ($item['produks'] as $produk)
                    
                        <li>
                            {{ $produk['name_produk'] }} { {{ number_format($produk['price'], 0, ',', '.') }} }
                            : Rp. {{ number_format($produk['sub_price'], 0, ',', '.') }} <small>qty {{ $produk['qty'] }}</small>
                        </li>
                    
                    @endforeach
                    </ol>
                </td>
                <td>Rp. {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                @php
                //setting localtime jadi wilayah indo
                    setLocale(LC_ALL, 'IND');
                @endphp
                {{--carbon package bawaan laravel untuk mengatur hal-hal yg berkaitan dengan tipe data date/datetime--}}
                <td>{{ Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}</td>
                {{-- <td><a href="{{ route('kasir.order.download', $item['id'])}}" class="btn btn-danger"><ion-icon name="download-outline"></ion-icon></a></td> --}}
                
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="d-flex justify-content-end">
        @if ($orders->count())
            {{ $orders->links() }}
        @endif
    </div> --}}
</div>
@endsection