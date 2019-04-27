@extends('layout')
@section('content')
    <form action="{{ route('product.update',$product) }}" method="post" >
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Product Name" value="{{ $product->name }}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="number" class="form-control" placeholder="10" step="any" value="{{ $product->price }}">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input name="quantity" type="number" class="form-control" placeholder="1"  value="{{ $product->quantity }}">
        </div>
        <button type="submit" class="btn btn-primary" >Update</button>
    </form>
@endsection
