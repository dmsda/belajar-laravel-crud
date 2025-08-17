@extends('layouts.main')
@section('title','Tambah Produk')

@section('content')
  <div class="max-w-2xl mx-auto bg-white border rounded-lg p-6">
    <h1 class="text-xl font-semibold mb-4">Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST">
      @include('products._form', ['submit' => 'Buat'])
    </form>
  </div>
@endsection
