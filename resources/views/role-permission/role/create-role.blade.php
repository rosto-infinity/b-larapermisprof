<x-app-layout>

  <div class="container mx-auto mt-6">
    <div class="row">
      <div class="col-md-12">
        {{-- -Affichage des erreurs de validation, le cas échéant --}}
        @if ($errors->any())
          <ul class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        @endif

        <div class="bg-white shadow-md rounded mt-3">
          <div class="px-4 py-2 border-b">
            <h4 class="flex justify-between items-center">
              Create Roles
              {{-- Lien pour retourner à la liste des rôles --}}
              <a href="{{ route('roles.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Back</a>
            </h4>
          </div>
          <div class="p-4">
            {{-- Formulaire POST pour créer un nouveau rôle --}}
            <form action="{{ route('roles.store') }}" method="POST" class="space-y-4">
              @csrf {{-- Protection contre les attaques CSRF --}}
               
              {{-- Champ pour le nom du rôle --}}
              <div>
                <label class="block text-gray-700" for="name">Role Name</label>
                <input type="text" name="name"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
              </div>
              
              {{-- Bouton pour soumettre le formulaire --}}
              <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>