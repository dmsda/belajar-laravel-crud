@vite(['resources/css/app.css', 'resources/js/app.js'])

<header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b">
  <nav class="container flex items-center justify-between h-14">
    {{-- BRAND / LOGO --}}
    <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-2.5 h-2.5 rounded-full bg-blue-600"></span>
      <span>Belajar Laravel</span>
    </a>

    {{-- HAMBURGER (MOBILE) --}}
    <button id="nav-toggle" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-md hover:bg-gray-100"
      aria-label="Toggle navigation">
      <!-- icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    {{-- LINKS (DESKTOP) --}}
    <ul class="hidden lg:flex items-center gap-1 text-sm">
      <li>
        <a href="{{ url('/') }}"
           class="@class([
             'px-3 py-2 rounded-md hover:bg-gray-100',
             request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-700'
           ])">
          Home
        </a>
      </li>
      <li>
        <a href="{{ route('products.index') }}"
           class="@class([
             'px-3 py-2 rounded-md hover:bg-gray-100',
             request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700'
           ])">
          Products
        </a>
      </li>
    </ul>

    {{-- AUTH AREA (DESKTOP) --}}
    <div class="hidden lg:flex items-center gap-2">
      @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
                  class="px-3 py-2 text-sm rounded-md border hover:bg-gray-50">
            Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-3 py-2 text-sm rounded-md hover:bg-gray-100">Login</a>
        <a href="{{ route('register') }}"
           class="px-3 py-2 text-sm rounded-md bg-blue-600 text-white hover:bg-blue-700">
          Register
        </a>
      @endauth
    </div>
  </nav>

  {{-- DRAWER (MOBILE) --}}
  <div id="nav-drawer" class="lg:hidden hidden border-t bg-white">
    <div class="container py-2">
      <a href="{{ url('/') }}"
         class="@class([
           'block px-3 py-2 rounded-md hover:bg-gray-100',
           request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-700'
         ])">
        Home
      </a>
      <a href="{{ route('products.index') }}"
         class="@class([
           'block px-3 py-2 rounded-md hover:bg-gray-100',
           request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700'
         ])">
        Products
      </a>
      <a href="{{ route('categories.index') }}" class="hover:text-blue-600">Categories</a>


      <div class="mt-2 border-t pt-2">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left block px-3 py-2 rounded-md border hover:bg-gray-50">
              Logout
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md hover:bg-gray-100">Login</a>
          <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
            Register
          </a>
        @endauth
      </div>
    </div>
  </div>
</header>

{{-- toggle drawer (tanpa library) --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('nav-toggle');
    const drawer = document.getElementById('nav-drawer');
    if (btn && drawer) {
      btn.addEventListener('click', () => drawer.classList.toggle('hidden'));
    }
  });
</script>
@yield('content')
