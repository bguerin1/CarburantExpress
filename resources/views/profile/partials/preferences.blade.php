<section>
    <header>
        
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Vos préférences') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Vous pouvez modifier vos préférences en termes de type de carburant utilisé ainsi que votre position.") }}
        </p>
    </header>
    

    <form method="post" action="{{ route('preferences.update') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <div class="flex-grow">
                <select id="type" name="type" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-3">
                    <option value="">Choisir un type de carburant...</option>
                    @foreach ($typeCarburants as $type)
                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <x-input-label for="position" :value="__('Position :')" class="mt-3"/>
            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $user->position)" required autofocus autocomplete="position" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <x-primary-button>{{ __('Modifier') }}</x-primary-button>
    </form>
</section>
