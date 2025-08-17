@csrf
<x-error-list />

<div class="grid md:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm font-medium mb-1">Nama</label>
    <input type="text" name="name"
      value="{{ old('name', $product->name ?? '') }}"
      class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Harga</label>
    <input type="number" step="0.01" name="price"
      value="{{ old('price', $product->price ?? '') }}"
      class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
  <label class="block text-sm font-medium mb-1">Kategori</label>
 <select name="category_id" required
  class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
  <option value="">-- Pilih Kategori --</option>
  @foreach($categories as $c)
    <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id ?? '') == $c->id)>
      {{ $c->name }}
    </option>
  @endforeach
</select>
  @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
</div>


  <div class="md:col-span-2">
    <label class="block text-sm font-medium mb-1">Deskripsi</label>
    <textarea name="description" rows="4"
      class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>
</div>

<div class="mt-6 flex items-center gap-3">
  <button type="submit"
    class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
    {{ $submit ?? 'Simpan' }}
  </button>

  <a href="{{ route('products.index') }}"
     class="inline-flex items-center px-4 py-2 rounded-md border hover:bg-gray-50">
    Batal
  </a>
</div>
