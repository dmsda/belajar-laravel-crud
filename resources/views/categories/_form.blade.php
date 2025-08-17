@csrf
<x-error-list />

<div class="max-w-md">
  <label class="block text-sm font-medium mb-1">Nama Kategori</label>
  <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
         class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
  @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
</div>

<div class="mt-6 flex items-center gap-3">
  <button type="submit" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
    {{ $submit ?? 'Simpan' }}
  </button>
  <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 rounded-md border hover:bg-gray-50">
    Batal
  </a>
</div>
