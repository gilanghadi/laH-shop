@extends('layouts.admin')
@section('title', 'Transaction Order')
@section('content')
    <div class="container">
        <div class="px-5 mt-4">
            <p class="fw-semibold fs-4">Products Transaction</p>
            <hr class="mb-4">
            <table class="table table-hover display" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NameProduct</th>
                        <th scope="col">Address</th>
                        <th scope="col">Telp</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Price</th>
                        <th scope="col">Metode</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $t)
                        <tr class="text-capitalize">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- <img src="{{ url('storage') }}/{{ \App\Models\Product::find($o->product_id)->image }}"
                                    alt="{{ $o->image }}" width="90"> --}}
                                <img src="{{ $t->order->product->image }}" alt="{{ $t->order->product->image }}"
                                    width="90">
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($t->user->name, '15', '..') }}</td>
                            <td>{{ $t->order->product->name }}</td>
                            <td>{{ $t->order->address }}</td>
                            <td>{{ $t->order->telp }}</td>
                            <td>{{ number_format($t->order->amount) }} Stock</td>
                            <td>{{ number_format($t->price) }}</td>
                            <td>{{ $t->order->metode }}</td>
                            <td>
                                @if ($t->status = 1)
                                    <span class="badge btn-secondarys">Terbayar</span>
                                @else
                                    <span class="badge btn-warnings">Belum Terbayar</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
