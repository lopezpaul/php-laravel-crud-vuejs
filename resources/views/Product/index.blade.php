@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12 text-right my-2">
            <span class="col-form-label">Backup Database</span>
            <a href="{{ url('backup/xml') }}" class="btn btn-primary  btn-sm">XML</a>
            <a href="{{ url('backup/json') }}" class="btn btn-primary  btn-sm">JSON</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right my-2">
            <div type="button" class="btn btn-success  btn-lg">
                Total <span class="badge badge-light">$ {{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalCount = 0; ?>
                @foreach ($products as $product)
                    <?php $totalCount += $product->total; ?>
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>${{ number_format($product->total, 2) }}</td>
                        <td>{{ 
                        \Carbon\Carbon::createFromTimestamp(strtotime($product->created_at))
                        ->diffForHumans([
                            'options' => \Carbon\CarbonInterface::JUST_NOW,
                            'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW,
                        ])
                        
                        }}</td>
                        <td>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('product.edit', $product) }}">Edit</a>
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
                <tr>
                    <td colspan="4" class="text-right">
                        <strong>Subtotal:</strong>
                    </td>
                    <td colspan="4" class="text-left">
                        <span>${{ number_format($totalCount, 2) }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@endsection
