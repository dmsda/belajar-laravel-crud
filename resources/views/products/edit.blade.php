@extends('layouts.main')
@section('title','Edit Produk')

@section('content')
  <div class="max-w-2xl mx-auto bg-white border rounded-lg p-6">
    <h1 class="text-xl font-semibold mb-4">Edit Produk</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
      @method('PUT')
      @include('products._form', ['submit' => 'Update'])
    </form>
  </div>
@endsection
