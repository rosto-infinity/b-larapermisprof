  @if (session()->has('success'))
      <div class="bg-green-200 text-green-800 px-4 py-2">
          {{ session('success') }}
      </div>
  @endif

  @if (session()->has('error'))
      <div class="bg-red-200 text-red-800 px-4 py-2">
          {{ session('error') }}
      </div>
  @endif
