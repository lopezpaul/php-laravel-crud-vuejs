@extends('layout')
@section('content')
    <edit-product></edit-product>
@endsection
@push('scripts')
        <script src="{{ mix('js/product/edit.js') }}" ></script>
@endpush
