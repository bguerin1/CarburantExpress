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
                    <h3 class="text-xl font-semibold mb-4">{{ __("Vos préférences :") }}</h3>

                    <div class="space-y-2">
                        <p class="text-lg font-medium">Type de carburant : <span class="font-normal">{{ Auth::user()->type_carburant->libelle }}</span></p>
                        <p class="text-lg font-medium">Position : <span class="font-normal">{{ Auth::user()->position }}</span></p>
                    </div>
                </div>
            </div>
            <form action="/filter" method="GET" class="mt-3">
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
