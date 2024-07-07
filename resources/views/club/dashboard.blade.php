
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You are a CLUB admin") }}
                </div>
                @if ($pendingRidersCount > 0)
                    <div class="p-6 bg-yellow-100 text-yellow-800 rounded-lg mt-4">
                        <p>You have {{ $pendingRidersCount }} rider(s) pending approval. 
                        <a href="{{ route('club.riders') }}" class="text-blue-500 underline">Click here to review them</a>.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>    
</x-app-layout>

