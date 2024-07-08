
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
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($registeredHorses as $horse)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $loop->index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_name_furigana }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_registration_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $horse->horse_sex }}</td>
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
                    <form method="POST" action="{{ route('club.storeHorse') }}" class="space-y-4 mt-6 {{ $errors->any() ? '' : 'hidden' }}" id="addHorseForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="horse_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">馬名 <span class="text-red-500">*</span></label>
                                <input type="text" name="horse_name" id="horse_name" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_name') }}" required>
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_name_furigana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">フリガナ <span class="text-red-500">*</span></label>
                                <input type="text" name="horse_name_furigana" id="horse_name_furigana" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_name_furigana') }}" required>
                                @error('horse_name_furigana')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">登録番号 <span class="text-red-500">*</span></label>
                                <input type="text" name="horse_registration_number" id="horse_registration_number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_registration_number') }}" required>
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_international_registration_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">国際登録番号</label>
                                <input type="text" name="horse_international_registration_number" id="horse_international_registration_number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_international_registration_number') }}">
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_sex" class="block text-sm font-medium text-gray-700 dark:text-gray-300">性別 <span class="text-red-500">*</span></label>
                                <select name="horse_sex" id="horse_sex" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                    <option value="" disabled {{ old('horse_sex') == '' ? 'selected' : '' }}>性別</option>
                                    <option value="セン" {{ old('horse_sex') == 'セン' ? 'selected' : '' }}>セン</option>
                                    <option value="牝" {{ old('horse_sex') == '牝' ? 'selected' : '' }}>牝</option>
                                    <option value="牡" {{ old('horse_sex') == '牡' ? 'selected' : '' }}>牡</option>
                                </select>
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">毛色</label>
                                <select name="horse_color" id="horse_color" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                                    <option value="" disabled {{ old('horse_color') == '' ? 'selected' : '' }}>毛色</option>
                                    <option value="鹿毛" {{ old('horse_color') == '鹿毛' ? 'selected' : '' }}>鹿毛</option>
                                    <option value="黒鹿毛" {{ old('horse_color') == '黒鹿毛' ? 'selected' : '' }}>黒鹿毛</option>
                                    <option value="栗毛" {{ old('horse_color') == '栗毛' ? 'selected' : '' }}>栗毛</option>
                                    <option value="芦毛" {{ old('horse_color') == '芦毛' ? 'selected' : '' }}>芦毛</option>
                                    <option value="栃栗毛" {{ old('horse_color') == '栃栗毛' ? 'selected' : '' }}>栃栗毛</option>
                                    <option value="青鹿毛" {{ old('horse_color') == '青鹿毛' ? 'selected' : '' }}>青鹿毛</option>
                                    <option value="青毛" {{ old('horse_color') == '青毛' ? 'selected' : '' }}>青毛</option>
                                    <option value="粕毛" {{ old('horse_color') == '粕毛' ? 'selected' : '' }}>粕毛</option>
                                    <option value="ブチ" {{ old('horse_color') == 'ブチ' ? 'selected' : '' }}>ブチ</option>
                                </select>
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">年齢</label>
                                <input type="number" name="horse_age" id="horse_age" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_age') }}" min="0">
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_breed" class="block text-sm font-medium text-gray-700 dark:text-gray-300">品種</label>
                                <input type="text" name="horse_breed" id="horse_breed" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_breed') }}">
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_origin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">原産地</label>
                                <input type="text" name="horse_origin" id="horse_origin" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_origin') }}">
                            </div>
                    
                            <div class="mb-4">
                                <label for="horse_owner" class="block text-sm font-medium text-gray-700 dark:text-gray-300">所有者</label>
                                <input type="text" name="horse_owner" id="horse_owner" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" value="{{ old('horse_owner') }}">
                            </div>
                    
                            <div class="mb-4">
                                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">国 <span class="text-red-500">*</span></label>
                                <select name="country_id" id="country_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md" required>
                                    <option value="" disabled {{ old('country_id') == '' ? 'selected' : '' }}>国を選択して下さい</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->country_id }}" {{ old('country_id') == $country->country_id ? 'selected' : '' }}>
                                            {{ $country->country_code }} - {{ $country->country_native_name }} {{ $country->country_emoji }}
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
    
    <script>
        document.getElementById('addHorseRow').addEventListener('click', function () {
            document.getElementById('addHorseForm').classList.remove('hidden');
        });

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
