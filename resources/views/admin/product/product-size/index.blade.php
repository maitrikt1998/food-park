@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Product Variants ({{ $product->name }})</h1>
    </div>

    <div>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Go Back</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                <h4>Create Product Size</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product-size.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card card-primary">
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $size->name }}</td>
                                <td>{{ $size->price }}</td>
                                <td>
                                    <a href='{{ route('admin.product-size.destroy',$size->id) }}' class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($sizes) === 0)
                            <tr>
                                <td colspan="3" class="text-center">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                <h4>Create Product Option</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product-option.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card card-primary">
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($options as $option)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $option->name }}</td>
                                <td>{{ $option->price }}</td>
                                <td>
                                    <a href='{{ route('admin.product-option.destroy',$option->id) }}' class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($options) === 0)
                            <tr>
                                <td colspan="3" class="text-center">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection


