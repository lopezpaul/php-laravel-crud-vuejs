@extends('layout')
@section('content')
    <form action="{{ route('product.store') }}" method="post" >
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Product Name">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="number" class="form-control" placeholder="10" step="any">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input name="quantity" type="number" class="form-control" placeholder="1">
        </div>
        <button type="submit" class="btn btn-primary" >Create</button>
    </form>
@endsection
