<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- Affichage des erreurs de validation, le cas échéant --}}
                @if ($errors->any())
                <ul class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-200 px-4 py-2">
                        <h4 class="font-bold text-lg">
                            Edit Role
                            {{-- Lien pour retourner à la liste des rôles --}}
                            <a href="{{ route('roles.index') }}" class="bg-red-500 text-white px-4 py-2 rounded float-right">Back</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        {{-- Formulaire POST pour mettre à jour un rôle existant --}}
                        <form action="{{ url('roles/'.$role->id) }}" method="POST">
                            @csrf {{-- Protection contre les attaques CSRF --}}
                            @method('PATCH') {{-- Spécifie que la méthode HTTP est PACTH pour la mise à jour --}}
  
                            {{-- Champ pour le nom du rôle --}}
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Role Name</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control border border-gray-300 rounded p-2 w-full" />
                            </div>
                            {{-- Bouton pour soumettre le formulaire de mise à jour --}}
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