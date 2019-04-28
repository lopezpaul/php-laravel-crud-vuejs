@extends('layout')
@section('content')
    <div class="row" >
        <div class="col-12 text-right my-2">
            <span class="col-form-label" >Backup Database</span>
            <a href="{{ url('backup/xml') }}" class="btn btn-primary  btn-sm" >XML</a>
            <a href="{{ url('backup/json') }}" class="btn btn-primary  btn-sm" >JSON</a>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table table-striped" >
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->total }}</td>
                    <td>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('product.edit',$product) }}">Edit</a>
                                <form action="{{ URL::route('product.destroy', $product) }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    {{ $products->links() }}
@endsection
