<x-app-layout>
    @include('role-permission.nav')
    <div class="container mx-auto mt-6">
       @include('role-permission.message')
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white shadow-md rounded mt-3">
                    <div class="px-4 py-2 border-b">
                        <h4 class="flex justify-between items-center">
                            Permissions
                            <a href="{{ url('permissions/create') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded">Add
                                Permission</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        <table class="min-w-full border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="border-b">Id</th>
                                    <th class="border-b">Name</th>
                                    <th class="border-b" width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Boucle pour afficher chaque permission --}}
                                @foreach ($permissions as $index => $permission)
                                    <tr class="text-center mt-2 {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                                        <td class="border-b py-3">{{ $permission->id }}</td>
                                        <td class="border-b">{{ $permission->name }}</td>
                                        <td class="border-b">

                                            {{-- Lien pour éditer la permission --}}
                                             @can('update permission')
                                            <a href="{{ url('permissions/' . $permission->id . '/edit') }}"
                                                class="bg-green-500 text-white my-5 px-2 py-1 rounded">Edit</a>
                                                @endcan

                                            {{-- Lien pour supprimer la permission --}}
                                 @can('delete permission')
                                             <a href="{{ url('permissions/'.$permission->id. '/delete') }}"
                                                 class="bg-red-500 text-white px-2 py-1 rounded mx-2"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');" 
                                                 >Delete</a>
                                
                                         @endcan         
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-5">

                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
