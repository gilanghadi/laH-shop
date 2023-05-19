@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="mt-3 px-5">
            <p class="fw-semibold fs-3 border-bottom pb-2 text-primarys">Products</p>
            <a href="{{ route('product.create') }}" class="btn mb-4 btn-secondarys">Add product</a>
            <table class="table table-hover display" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">NameProduct</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr class="text-capitalize">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- <img src="{{ url('storage') }}/{{ $p->image }}" alt="{{ $p->image }}"
                                    width="90"> --}}
                                <img src="{{ $p->image }}" alt="{{ $p->image }}" width="90">
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($p->name, '15', '..') }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ number_format($p->price) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($p->desc, '15', '..') }}</td>
                            <td>
                                <a href="{{ route('product.edit', $p->id) }}" class="btn btn-warnings"><i
                                        class="bi bi-pen"></i></a>
                                <a href="{{ route('product.destroy', $p->id) }}" class="btn btn-dangers"><i
                                        class="bi bi-trash2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
