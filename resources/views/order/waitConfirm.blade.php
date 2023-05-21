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
                                    @if ($o->metode === 'cod')
                                        <a href="#" class="btn disabled border-0 btn-primarys">Cancel</a>
                                    @else
                                        @if (count($transaction) > 0)
                                            @if (App\Models\Transaction::where('user_id', '=', Auth::user()->id)->where('order_id', '=', $o->id)->count() > 0)
                                                <a class="btn disabled border-0 btn-primarys">paid</a>
                                            @else
                                                <a a class="btn btn-warnings" id="toggle-order" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" data-metode="{{ $o->metode }}"
                                                    data-amount="{{ $o->amount }}"
                                                    data-price="{{ $o->price }}">Pay</a>
                                            @endif
                                        @else
                                            <a class="btn btn-warnings" id="toggle-order" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop" data-metode="{{ $o->metode }}"
                                                data-amount="{{ $o->amount }}" data-price="{{ $o->price }}">Pay</a>
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


    @if (count($order) > 0)
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="bg-white rounded-3 modal-dialog">
                <form action="{{ route('transaction.store', $o->id) }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5  text-uppercase" id="staticBackdropLabel">Pembayaran Melalui <strong
                                    id="metode">
                                </strong></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label me-2">No_Rekening <strong
                                        id="metode1" class="text-capitalize"></strong></label>
                                <input type="number" class="form-control bg-transparent" name="no_rekening"
                                    id="exampleFormControlInput3" placeholder="Your Rekening Number" required>
                            </div>
                            <div class="mb-3">
                                <span class="text-capitalize d-block mb-2">Jumlah <strong id="amount"></strong>
                                    Products</span>
                                <label for="exampleFormControlInput3" class="form-label me-2"> Total Harga:
                                    <span class="p-1 rounded-md me-2 rounded-3 px-2 btn-secondarys" id="price">
                                    </span>IDR</label>
                                <input type="number" class="form-control bg-transparent" name="price"
                                    id="exampleFormControlInput3" placeholder="Amount To Be Paid" required>
                            </div>
                        </div>
                        <div class="mt-1 p-3 text-end">
                            <button type="button" class="btn btn-primarys"data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondarys">Pay</button>
                        </div>
                </form>
            </div>
        </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", "#toggle-order", function() {
                let metode = $(this).data('metode')
                let amount = $(this).data('amount')
                let price = $(this).data('price')
                $("#metode").text(metode)
                $("#metode1").text(metode)
                $("#amount").text(amount)
                $("#price").text(price)
            })
        })
    </script>
@endsection
