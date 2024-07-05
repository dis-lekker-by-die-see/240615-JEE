<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Club Details') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (isset($club) && isset($club->country))
                        <img src="{{ asset($club->country->country_flag_4x3) }}" alt="{{ $club->country->country_name }} flag" class="mt-1 block w-16" style="border: 0.5px solid black;">
                    @endif
                </div>
                <div class="container">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('club.store') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="club_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Club Name <span class="text-red-500">*</span></label>
                                <input type="text" name="club_name" id="club_name" value="{{ $club->club_name ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="club_registration_officer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Registration Officer <span class="text-red-500">*</span></label>
                                <input type="text" name="club_registration_officer" id="club_registration_officer" value="{{ $club->club_registration_officer ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="club_mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mobile <span class="text-red-500">*</span></label>
                                <input type="text" name="club_mobile" id="club_mobile" value="{{ $club->club_mobile ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="club_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                <input type="text" name="club_phone" id="club_phone" value="{{ $club->club_phone ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="club_fax" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fax</label>
                                <input type="text" name="club_fax" id="club_fax" value="{{ $club->club_fax ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="club_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address <span class="text-red-500">*</span></label>
                                <input type="text" name="club_address" id="club_address" value="{{ $club->club_address ?? '' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country <span class="text-red-500">*</span></label>
                                <select name="country_id" id="country_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->country_id }}" {{ (isset($club) && $club->country_id == $country->country_id) ? 'selected' : '' }}>
                                            {{ $country->country_code }} - {{ $country->country_native_name }} {{ $country->country_emoji }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="association_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Association <span class="text-red-500">*</span></label>
                                <select name="association_id" id="association_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                    <option value="" disabled selected>Select Association</option>
                                    @foreach($associations as $association)
                                        <option value="{{ $association->association_id }}" {{ (isset($club) && $club->association_id == $association->association_id) ? 'selected' : '' }}>
                                            {{ $association->association_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (isset($club) && $club->is_approved_by_association)
                                    <p class="text-green-500 mt-2">Approved by {{ $club->association->association_name }}</p>
                                @else
                                    <p class="text-red-500 mt-2">Not Yet Approved</p>
                                @endif
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
