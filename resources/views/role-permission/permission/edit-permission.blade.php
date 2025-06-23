<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <ul class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative"
                        role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-200 px-4 py-2">
                        <h4 class="font-bold text-lg">
                            Edit Permission
                            <a href="{{ route('permissions.index') }}"
                                class="bg-red-500 text-white px-4 py-2 rounded floatright">Back</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Permission
                                    Name</label>
                                <input type="text" name="name" value="{{ $permission->name }}"
                                    class="form-control border border-gray-300 rounded p-2 w-full" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
