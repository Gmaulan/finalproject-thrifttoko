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

        .text-light {
            color: #007bff;
        }

        .text-bg-dark {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .card {
            background-color: #007bff;
        }
    </style>
@endsection

@section('main')
    @include('layouts.nav')
    @include('components.hero')
    <div class="container-fluid text-center">
        <h3 class="text-light">Pakaian Terbaru</h3>
        <div class="d-flex flex-wrap justify-content-evenly">
            @foreach ($data_pakaian as $items)
                @php
                    $kategori = \App\Models\Kategori_Pakaian::find($items->pakaian_kategori_pakaian_id);
                    $pakaianStok = $items->pakaian_stok;
                    $kategoriStatus = $kategori->kategori_pakaian_status;
                @endphp
                @if ($pakaianStok > 0 && $kategoriStatus > 0)
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
            @endforeach
        </div>
    </div>
@endsection

@section('footer')
    <div class="container-flex text-center p-4" style="background: #007bff">
        <div class="card text-center" style="background: #007bff">
            <div class="card-header" style="background: #007bff">
            </div>
            <div class="card-body">
                <h5 class="card-title">Thrift Store</h5>
                <p class="card-text">Your Wallet is Our Best Friend</p>
                <a href="#" class="btn btn-primary">Affordable Fashion, Unbeatable Prices</a>
            </div>
            <div class="card-footer text-body-secondary" style="background: #007bff">
                Copyright &copy; Thrift Store 2023
            </div>
        </div>
    </div>
@endsection
