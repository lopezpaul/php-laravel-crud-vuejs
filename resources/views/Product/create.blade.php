@extends('layout')
@section('content')
    <create-product />
@endsection
@push('scripts')
    <script src="{{ mix('js/product/create.js') }}" ></script>
@endpush

