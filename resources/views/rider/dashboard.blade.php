{{-- 
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
                    @if (isset($rider->country))
                        <img src="{{ asset($rider->country->country_flag_4x3) }}" alt="{{ $rider->country->country_name }} flag" class="mt-1 block w-16" style="border: 0.5px solid black;">
                    @endif
                </div>
                <div class="container">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('rider.dashboard.store') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="rider_first_names" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Names</label>
                                <input type="text" name="rider_first_names" id="rider_first_names" value="{{ $rider->rider_first_names ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_first_names_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Names Furigana</label>
                                <input type="text" name="rider_first_names_furigana" id="rider_first_names_furigana" value="{{ $rider->rider_first_names_furigana ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                                <input type="text" name="rider_last_name" id="rider_last_name" value="{{ $rider->rider_last_name ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_last_name_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name Furigana</label>
                                <input type="text" name="rider_last_name_furigana" id="rider_last_name_furigana" value="{{ $rider->rider_last_name_furigana ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Registration Number</label>
                                <input type="text" name="rider_registration_number" id="rider_registration_number" value="{{ $rider->rider_registration_number ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_international_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">International Registration Number</label>
                                <input type="text" name="rider_international_registration_number" id="rider_international_registration_number" value="{{ $rider->rider_international_registration_number ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_sex" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sex</label>
                                <select name="rider_sex" id="rider_sex" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    <option value="女子" {{ (isset($rider) && $rider->rider_sex == '女子') ? 'selected' : '' }}>女子</option>
                                    <option value="男子" {{ (isset($rider) && $rider->rider_sex == '男子') ? 'selected' : '' }}>男子</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="rider_date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                <input type="date" name="rider_date_of_birth" id="rider_date_of_birth" value="{{ $rider->rider_date_of_birth ? $rider->rider_date_of_birth->format('Y-m-d') : '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                                <select name="country_id" id="country_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->country_id }}" {{ (isset($rider) && $rider->country_id == $country->country_id) ? 'selected' : '' }}>
                                            {{ $country->country_code }} - {{ $country->country_native_name }} {{ $country->country_emoji }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="club_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Club</label>
                                <select name="club_id" id="club_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    @foreach($clubs as $club)
                                        <option value="{{ $club->club_id }}" {{ (isset($rider) && $rider->club_id == $club->club_id) ? 'selected' : '' }}>
                                            {{ $club->club_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

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
                    @if (isset($rider) && isset($rider->country))
                        <img src="{{ asset($rider->country->country_flag_4x3) }}" alt="{{ $rider->country->country_name }} flag" class="mt-1 block w-16" style="border: 0.5px solid black;">
                    @endif
                </div>
                <div class="container">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('rider.dashboard.store') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="rider_first_names" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Names</label>
                                <input type="text" name="rider_first_names" id="rider_first_names" value="{{ $rider->rider_first_names ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_first_names_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Names Furigana</label>
                                <input type="text" name="rider_first_names_furigana" id="rider_first_names_furigana" value="{{ $rider->rider_first_names_furigana ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                                <input type="text" name="rider_last_name" id="rider_last_name" value="{{ $rider->rider_last_name ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_last_name_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name Furigana</label>
                                <input type="text" name="rider_last_name_furigana" id="rider_last_name_furigana" value="{{ $rider->rider_last_name_furigana ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Registration Number</label>
                                <input type="text" name="rider_registration_number" id="rider_registration_number" value="{{ $rider->rider_registration_number ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_international_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">International Registration Number</label>
                                <input type="text" name="rider_international_registration_number" id="rider_international_registration_number" value="{{ $rider->rider_international_registration_number ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="rider_sex" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sex</label>
                                <select name="rider_sex" id="rider_sex" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    <option value="女子" {{ (isset($rider) && $rider->rider_sex == '女子') ? 'selected' : '' }}>女子</option>
                                    <option value="男子" {{ (isset($rider) && $rider->rider_sex == '男子') ? 'selected' : '' }}>男子</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="rider_date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                <input type="date" name="rider_date_of_birth" id="rider_date_of_birth" value="{{ isset($rider->rider_date_of_birth) ? $rider->rider_date_of_birth->format('Y-m-d') : 'yyyy-mm-dd' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                                <select name="country_id" id="country_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->country_id }}" {{ (isset($rider) && $rider->country_id == $country->country_id) ? 'selected' : '' }}>
                                            {{ $country->country_code }} - {{ $country->country_native_name }} {{ $country->country_emoji }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="club_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Club</label>
                                <select name="club_id" id="club_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    @foreach($clubs as $club)
                                        <option value="{{ $club->club_id }}" {{ (isset($rider) && $rider->club_id == $club->club_id) ? 'selected' : '' }}>
                                            {{ $club->club_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
