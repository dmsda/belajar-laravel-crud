@extends('layouts.main')
@section('title','Daftar Produk')

@section('content')
  <div class="max-w-5xl mx-auto space-y-6">  {{-- <— wrapper vertikal, tidak grid dua kolom --}}

    {{-- HEADER --}}
    <div class="flex items-center justify-between flex-wrap gap-3">
      <div>
        <h1 class="text-2xl font-semibold">Daftar Produk</h1>
        <p class="text-sm text-gray-500">Kelola produk dengan CRUD Eloquent</p>
      </div>
      <a href="{{ route('products.create') }}"
         class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm px-4 py-2 rounded-md hover:bg-blue-700">
        + Tambah Produk
      </a>
    </div>

    <form method="GET" class="mb-4">
    <select name="category" onchange="this.form.submit()"
      class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
      <option value="">-- Semua Kategori --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(request('category') == $c->id)>
          {{ $c->name }}
        </option>
      @endforeach
    </select>
    </form>

    {{-- TABLE --}}
    <div class="overflow-x-auto border rounded-lg bg-white">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>  
        </thead>
        <tbody class="divide-y">
          @foreach ($products as $p)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-3">{{ $p->id }}</td>
              <td class="px-4 py-3 font-medium">{{ $p->name }}</td>        {{-- Nama Produk --}}
                <td class="px-4 py-3">{{ $p->category?->name ?? '—' }}</td> {{-- Nama Kategori --}}
              <td class="px-4 py-3">Rp {{ number_format($p->price,0,',','.') }}</td>
              <td class="px-4 py-3 text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
              <td class="px-4 py-3">
  <div class="flex items-center gap-2 whitespace-nowrap">
    @can('update', $p)
      <a href="{{ route('products.edit',$p) }}"
         class="inline-flex items-center px-3 py-1.5 text-xs rounded-md bg-amber-500 text-white hover:bg-amber-600">
        Edit
      </a>
    @endcan

    @can('delete', $p)
      <form action="{{ route('products.destroy',$p) }}" method="POST"
            class="m-0 inline-flex"
            onsubmit="return confirm('Hapus produk ini?')">
        @csrf @method('DELETE')
        <button type="submit"
          class="inline-flex items-center px-3 py-1.5 text-xs rounded-md bg-red-600 text-white hover:bg-red-700">
          Hapus
        </button>
      </form>
    @endcan
  </div>
</td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-2">
      {{ $products->onEachSide(1)->links() }}
    </div>
  </div>
@endsection
