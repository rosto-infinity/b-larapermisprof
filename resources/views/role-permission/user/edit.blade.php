<x-app-layout>

  <div class="container mx-auto mt-5">
      <div class="w-full">

          @if ($errors->any())
          <ul class="bg-yellow-300 text-yellow-800 p-4 rounded mb-4">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
          @endif

          <div class="bg-white shadow-md rounded">
              <div class="px-4 py-2 border-b">
                  <h4 class="text-lg font-semibold">Edit User
                      <a href="{{ url('users') }}" class="bg-red-500 text-white float-right px-4 py-2 rounded">Back</a>
                  </h4>
              </div>
              <div class="p-4">
                  <form action="{{ url('users/'.$user->id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="mb-4">
                          <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
                          <input type="text" name="name" value="{{ $user->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
                          @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-4">
                          <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                          <input type="text" name="email" readonly value="{{ $user->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" />
                      </div>
                      <div class="mb-4">
                          <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                          <input type="text" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
                          @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-4">
                          <label class="block text-sm font-medium text-gray-700" for="roles">Roles</label>
                          <select name="roles[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" multiple>
                              <option value="">Select Role</option>
                              @foreach ($roles as $role)
                              <option
                                  value="{{ $role }}"
                                  {{ in_array($role, $userRoles) ? 'selected' : '' }}
                              >
                                  {{ $role }}
                              </option>
                              @endforeach
                          </select>
                          @error('roles') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                      </div>
                      <div class="mb-4">
                          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

</x-app-layout>
