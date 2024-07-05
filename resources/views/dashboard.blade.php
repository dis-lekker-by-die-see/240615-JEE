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
                    {{ __("") }}
                </div>
                <div class="container">
                    @if ($user->role === 'rider')
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("dashboard.blade.php: You are a RIDER") }}
                        </div>
                    @elseif ($user->role === 'club')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("dashboard.blade.php: You are a CLUB admin") }}
                    </div>
                    @elseif ($user->role === 'association')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("dashboard.blade.php: You are an ASSOCIATION organizing events") }}
                    </div>
                    @elseif ($user->role === 'kami')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("dashboard.blade.php: You are the GOD of this universe") }}
                    </div>
                    @else
                        <p>You are a black hole with no ROLE</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
