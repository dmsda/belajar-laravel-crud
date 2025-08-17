@extends('layouts.main')
@section('title','Edit Kategori')

@section('content')
  <div class="max-w-xl bg-white border rounded-lg p-6">
    <h1 class="text-xl font-semibold mb-4">Edit Kategori</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
      @method('PUT')
      @include('categories._form', ['submit' => 'Update'])
    </form>
  </div>
@endsection
