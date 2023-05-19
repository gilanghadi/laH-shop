@extends('layouts.app')
@section('title', 'laH?shop')
@section('content')
    <div class="container">
        <div class="mt-3 px-5">
            <p class="fw-semibold fs-3 border-bottom pb-2 mb-4 text-primarys">Products Order</p>
            <table class="table table-hover display" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">NameProduct</th>
                        <th scope="col">Price / Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Metode</th>
                        <th scope="col">Order At</th>
                        <th scope="col">Confirm At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $o)
                        <tr class="text-capitalize">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- <img src="{{ url('storage') }}/{{ \App\Models\Product::find($o->product_id)->image }}"
                                    alt="{{ $o->image }}" width="90"> --}}
                                <img src="{{ \App\Models\Product::find($o->product_id)->image }}" alt="{{ $o->image }}"
                                    width="90">
                            </td>
                            <td>{{ \App\Models\Product::find($o->product_id)->name }}</td>
                            <td>{{ number_format(\App\Models\Product::find($o->product_id)->price) }}</td>
                            <td>{{ number_format($o->price) }}</td>
                            <td>{{ number_format($o->amount) }} stock</td>
                            <td>{{ $o->metode }}</td>
                            <td>{{ date('d-m-Y', strtotime($o->created_at)) }}</td>

                            @if (strtotime($o->updated_at) === strtotime($o->created_at))
                                <td> Just Waiting... </td>
                            @else
                                <td>{{ date('d-m-Y', strtotime($o->updated_at)) }}</td>
                            @endif
                            <td>
                                @if ($o->is_confirmed == 1)
                                    <span class="badge btn-secondarys">Confirmed</span>
                                @else
                                    <span class="badge btn-warnings">Pendding</span>
                                @endif
                            </td>
                            <td>
                                @if ($o->is_confirmed == 1)
                                    @if ($o->metode == 'cod')
                                        <a href="#" class="btn disabled border-0 btn-primarys">Cancel</a>
                                    @else
                                        @if (count($transaction) > 0)
                                            @if (App\Models\Transaction::where('user_id', '=', Auth::user()->id)->where('order_id', '=', $o->id)->count() > 0)
                                                <a href="#" class="btn disabled border-0 btn-primarys">paid</a>
                                            @else
                                                <a href="#" class="btn btn-warnings" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">Pay</a>
                                            @endif
                                        @else
                                            <a href="" class="btn btn-warnings" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Pay</a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('order.destroy', $o->id) }}" class="btn btn-dangers">Cancel</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('home') }}" class="btn btn-primarys"><i class="bi bi-arrow-left"></i></a>
        </div>
    </div>
@endsection
