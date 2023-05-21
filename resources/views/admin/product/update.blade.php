@extends('layouts.admin')
@section('title', 'Update Product')
@section('content')
    <div class="container mt-4">
        <div class="rounded-md rounded-3">
            <p class="fs-3 fw-semibold border-bottom pb-3"> Update Products</p>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name Product</label>
                                <input type="text"
                                    class="form-control text-primarys rounded-0 text-capitalize border-0 border-bottom"
                                    name="name" id="exampleFormControlInput1" value="{{ old('name', $product->name) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Stock</label>
                                <input type="number" class="form-control text-primarys rounded-0 border-0 border-bottom"
                                    name="stock" id="exampleFormControlInput2" value="{{ old('stock', $product->stock) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Price</label>
                                <input type="number" class="form-control text-primarys rounded-0 border-0 border-bottom"
                                    name="price" id="exampleFormControlInput3" value="{{ old('price', $product->price) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput4" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image"
                                    value="{{ old('image', $product->image) }}" id="exampleFormControlInput4" required
                                    onchange="preview()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control text-primarys text-capitalize" name="desc" id="exampleFormControlTextarea1"
                                    rows="3">{{ old('desc', $product->desc) }}"</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @if ($product->image)
                                <img src="{{ $product->image }}" alt="" id="img-preview"
                                    class="w-50 mb-2 rounded-3">
                            @endif
                            <img src="" alt="" id="img-preview" class="w-50 mb-2 rounded-3">
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.home') }}" class="btn btn-secondarys"><i class="bi bi-arrow-left"></i></a>
                        <button class="btn btn-primarys">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript">
        function preview() {
            const imgPreview = document.querySelector('#img-preview')
            const inputImage = document.querySelector('#exampleFormControlInput4')
            imgPreview.style.display = 'block'

            const ofReader = new FileReader()
            ofReader.readAsDataURL(inputImage.files[0])

            ofReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result
            }
        }
    </script>
@endsection
