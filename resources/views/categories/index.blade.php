@extends('layouts.main')
@section('title','Kategori')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Kategori</h1>
      <p class="text-sm text-gray-500">Kelola kategori produk</p>
    </div>
    <a href="{{ route('categories.create') }}"
       class="inline-flex items-center bg-blue-600 text-white text-sm px-4 py-2 rounded-md hover:bg-blue-700">
      + Tambah Kategori
    </a>
  </div>

  @if(session('success')) <x-alert type="success" class="mb-4">{{ session('success') }}</x-alert> @endif
  @if(session('error'))   <x-alert type="error"   class="mb-4">{{ session('error') }}</x-alert>   @endif

  <div class="overflow-x-auto border rounded-lg bg-white">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 text-gray-600">
        <tr>
          <th class="text-left font-medium px-4 py-3">Nama</th>
          <th class="text-left font-medium px-4 py-3">Jumlah Produk</th>
          <th class="text-left font-medium px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @forelse($categories as $c)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 font-medium">{{ $c->name }}</td>
            <td class="px-4 py-3 text-gray-500">{{ $c->products()->count() }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-2">
                <a href="{{ route('categories.edit',$c) }}"
                   class="px-3 py-1.5 text-xs rounded-md bg-amber-500 text-white hover:bg-amber-600">Edit</a>
                <form action="{{ route('categories.destroy',$c) }}" method="POST"
                      onsubmit="return confirm('Hapus kategori ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="px-3 py-1.5 text-xs rounded-md bg-red-600 text-white hover:bg-red-700">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">Belum ada kategori</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $categories->links() }}</div>
@endsection
