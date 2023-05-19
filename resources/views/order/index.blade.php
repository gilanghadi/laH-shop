@extends('layouts.app')
@section('title', 'Order Product')
@section('content')
    <div class="container">
        <div class="mt-4 px-5">
            <div class="row">
                <div class="col-lg-6">
                    {{-- <img src="{{ url('storage') }}/{{ $product->image }}" alt="{{ $product->image }}" width="200"> --}}
                    <img src="{{ $product->image }}" alt="{{ $product->image }}" class="w-100">
                </div>
                <div class="col-lg-6">
                    <p class="fw-semibold fs-3 text-primarys">{{ $product->name }}</p>
                    <span class="text-danger fs-4">{{ number_format($product->price) }} IDR</span>
                    <p>{{ $product->desc }}</p>
                </div>
            </div>
            <hr class="mb-4">
            <form action="{{ route('order.store', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Address</label>
                    <input type="type" class="form-control text-capitalize" name="address" id="exampleFormControlInput3"
                        required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Postcode</label>
                    <input type="number" class="form-control" name="postcode" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Amount</label><span
                        class="px-2 rounded-3 btn-primarys">{{ $product->stock }} Stock</span>
                    <input type="number" class="form-control" name="amount" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Telp</label>
                    <input type="number" class="form-control" name="telp" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Metode Pembayaran</label>
                    <select class="form-select" aria-label="Default select example" name="metode">
                        <option selected disabled>Pilih Metode..</option>
                        <option value="cod">COD</option>
                        <option value="bca">BCA</option>
                        <option value="bni">BNI</option>
                        <option value="bri">BRI</option>
                    </select>
                </div>

                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primarys"><i class="bi bi-arrow-left"></i></a>
                    <button type="submit" class="btn btn-secondarys">Order Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
