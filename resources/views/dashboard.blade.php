<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md text-gray-900 dark:text-gray-100">
                    <!-- Affichage message flash de type "success" -->
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Affichage message flash de type "error" -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled text-start m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h3 class="text-xl font-semibold mb-4">{{ __("Vos préférences :") }}</h3>

                    <div class="space-y-2">
                        <p class="text-lg font-medium">Type de carburant : <span class="font-normal">{{ Auth::user()->type_carburant->libelle }}</span></p>
                        <p class="text-lg font-medium">Position : <span class="font-normal">{{ Auth::user()->position }}</span></p>
                    </div>
                </div>
            </div>
            <form action="/filter" method="get" class="mt-3">
                @csrf
                <input type="hidden" value="{{Auth::user()->type_carburant->libelle}}" name="type">
                <input type="hidden" value="{{Auth::user()->position}}" name="search">
                <x-primary-button>
                    {{ __('Trouver une station à partir de mes préférences') }}
                </x-primary-button>
            </form>
        </div>
    </div>

</x-app-layout>
