@extends('layouts.app')

@auth
    @php $userRole = Auth::user()->user_level; @endphp
@endauth

@section('title', 'Dashboard')

@section('header')
    <style>
        body {
            background-color: #202340;
            width: 100vw;
            height: 100vh;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
@endsection

@section('main')
    @include('layouts.nav')
    <div class="container-fluid text-center mt-5">
        <h3 class="text-light">Hasil Pencarian : {{ $search }}</h3>
        <div class="d-flex flex-wrap justify-content-evenly mt-5">
            @foreach ($data_pakaian as $items)
                @php
                    $kategori = \App\Models\Kategori_Pakaian::find($items->pakaian_kategori_pakaian_id);
                    $pakaianStok = $items->pakaian_stok;
                    $kategoriStatus = $kategori->kategori_pakaian_status;
                @endphp
                @if ($pakaianStok > 0 && $kategoriStatus > 0)
                    @if (empty($search) || Str::contains(strtolower($items->pakaian_nama), strtolower($search)))
                        <div class="card text-bg-dark m-2" style="width: 18rem;">
                            @if ($items->pakaian_gambar_url === '' || $items->pakaian_gambar_url === null)
                                <img width="100%" height="100%" src="{{ asset('img/clothes.png') }}" class="card-img-top"
                                    alt="...">
                            @else
                                <img width="100%" height="100%"
                                    src="{{ asset('storage/pakaian/gambar/' . basename($items->pakaian_gambar_url)) }}"
                                    class="card-img-top" alt="...">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $items->pakaian_nama }}</h5>
                                <p class="card-text">Rp. {{ $items->pakaian_harga }}</p>
                                <a href="{{ route('detail', ['pakaian_id' => $items->pakaian_id]) }}"
                                    class="btn btn-primary">Get Detail</a>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('footer')
@endsection
