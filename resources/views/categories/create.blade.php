@extends('layouts.main')
@section('title','Tambah Kategori')

@section('content')
  <div class="max-w-xl bg-white border rounded-lg p-6">
    <h1 class="text-xl font-semibold mb-4">Tambah Kategori</h1>
    <form action="{{ route('categories.store') }}" method="POST">
      @include('categories._form', ['submit' => 'Buat'])
    </form>
  </div>
@endsection
