@extends('layouts.app')
@section('title', 'laH?shop')
@section('content')
    <div class="container">
        <div class="row flex-wrap justify-content-start">
            @foreach ($products as $p)
                <div class="col-sm-3 mb-5 p-1">
                    <div>
                        {{-- <img src="{{ url('storage') }}/{{ $p->image }}" class="card-img-top w-100 rounded-3"
                            alt="{{ $p->image }}" style="min-height: 180px;"> --}}
                        <img src="{{ $p->image }}" class="card-img-top w-100 rounded-3" alt="{{ $p->image }}"
                            style="min-height: 180px;">
                    </div>
                    <div class="card-body">
                        <hr>
                        <h5 class="card-title fw-semibold mb-2">{{ \Illuminate\Support\Str::limit($p->name, 16) }}</h5>
                        <div class="d-flex">
                            <span class="card-text me-2 text-danger">{{ number_format($p->price) }} IDR</span>
                            <span class="px-3 py-0 rounded-3 rounded-md btn-primarys">{{ number_format($p->stock) }}
                                Stock</span>

                        </div>
                        <p class="card-text mt-1">{{ \Illuminate\Support\Str::limit($p->desc, 25, '...') }}</p>
                        <div class="d-flex">
                            <a href="{{ route('whistlist.store', $p->id) }}"
                                class="p-2 me-1 rounded-md rounded-3 text-decoration-none btn-primarys"><i
                                    class="bi bi-bag-plus px-2"></i></a>
                            <a href="{{ route('order.show', $p->id) }}"
                                class="p-2 rounded-md rounded-3 text-decoration-none btn-secondarys"><i
                                    class="bi bi-cart me-2"></i>Pesan
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}
        </div>
    </div>
@endsection
