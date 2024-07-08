

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('馬管理') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">        
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">馬一覧</h3>
                        <div id="horsesTableContainer">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">番</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">馬名</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">フリガナ</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">登録番号</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">性別</th>
                                        {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ユーザ有り</th> --}}
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($registeredHorses as $horse)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $loop->index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_name_furigana }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_registration_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->rhorse_sex }}</td>
                                                                         
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-red-600 dark:text-red-400 hover:text-red-900" onclick="confirmDeleteHorse('{{ $horse->horse_id }}')">削除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button id="addHorseRow" class="addRowButton bg-blue-500 text-white px-4 py-2 rounded-md mt-4">追加</button>

                    <form method="POST" action="{{ route('club.storeHorse') }}" class="space-y-4 mt-6 hidden" id="addHorseForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- <div class="mb-4">
                                <label for="rider_first_names" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Names <span class="text-red-500">*</span></label>
                                <input type="text" name="rider_first_names" id="rider_first_names" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                            </div>
                    
                            <div class="mb-4">
                                <label for="rider_first_names_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Names Furigana <span class="text-red-500">*</span></label>
                                <input type="text" name="rider_first_names_furigana" id="rider_first_names_furigana" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                @error('rider_first_names_furigana')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="mb-4">
                                <label for="rider_last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="rider_last_name" id="rider_last_name" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                            </div>
                    
                            <div class="mb-4">
                                <label for="rider_last_name_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name Furigana <span class="text-red-500">*</span></label>
                                <input type="text" name="rider_last_name_furigana" id="rider_last_name_furigana" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                @error('rider_last_name_furigana')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="mb-4">
                                <label for="rider_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Registration Number</label>
                                <input type="text" name="rider_registration_number" id="rider_registration_number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>
                    
                            <div class="mb-4">
                                <label for="rider_international_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">International Registration Number</label>
                                <input type="text" name="rider_international_registration_number" id="rider_international_registration_number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                            </div>
                    
                            <div class="mb-4">
                                <label for="rider_sex" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sex <span class="text-red-500">*</span></label>
                                <select name="rider_sex" id="rider_sex" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                    <option value="" disabled selected>性別</option>
                                    <option value="女子">女子</option>
                                    <option value="男子">男子</option>
                                </select>
                            </div>
                    
                            <div>
                                <label for="rider_date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth <span class="text-red-500">*</span></label>
                                <input type="date" name="rider_date_of_birth" id="rider_date_of_birth" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country <span class="text-red-500">*</span></label>
                                <select name="country_id" id="country_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                    <option value="" disabled selected>国を選択して下さい</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->country_id }}">
                                            {{ $country->country_code }} - {{ $country->country_native_name }} {{ $country->country_emoji }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
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
    

    <script>
        
    
        

        // document.getElementById('addRiderRow').addEventListener('click', function () {
        //     document.getElementById('addRiderForm').classList.remove('hidden');
        // });

        function confirmDeleteHorse(horseId) {
            if (confirm('Are you sure you want to delete this horse?')) {
                deleteHorse(horseId);
            }
        }

        function deleteHorse(horseId) {
            fetch(`/club/horses/${horseId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
            }).then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page or update the DOM as necessary
                } else {
                    alert('Failed to delete horse.');
                }
            });
        }
    </script>
    
</x-app-layout>
