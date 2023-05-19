@extends('layouts.admin')

@section('title', 'Order Confirm')

@section('content')
    <div class="container">
        <div class="px-5 mt-4">
            <p class="fw-semibold fs-4">Products Confirm</p>
            <hr class="mb-4">
            <table class="table" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price / Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Order At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $o)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ App\Models\User::find($o->user_id)->name }}</td>
                            <td>{{ App\Models\Product::find($o->product_id)->name }}</td>
                            <td>Rp. {{ number_format(App\Models\Product::find($o->product_id)->price) }}</td>
                            <td>Rp. {{ number_format($o->price) }}</td>
                            <td>{{ number_format($o->amount) }} Stock</td>
                            <td>{{ date('d-m-Y', strtotime($o->created_at)) }}</td>
                            <td>
                                @if ($o->is_confirmed == 1)
                                    <span class="badge btn-secondarys">Confirmed</span>
                                @else
                                    <span class="badge btn-warnings">Pendding</span>
                                @endif
                            </td>
                            <td>
                                @if ($o->is_confirmed == 0)
                                    <a href="{{ route('orderAdmin.confirm', $o->id) }}" class="btn btn-secondarys">Confirm
                                    </a>
                                @else
                                    <a href="{{ route('orderAdmin.cancel', $o->id) }}"
                                        class="btn btn-dangers">Unconfirmed</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
