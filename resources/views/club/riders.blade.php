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
                <div class="container">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Riders for Approval</h3>
                        @if ($ridersForApproval->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">No riders awaiting approval.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rider Name</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($ridersForApproval as $rider)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $rider->rider_last_name }} {{ $rider->rider_first_names }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" onclick="openModal('{{ $rider->rider_id }}')">Review Rider Info</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div id="riderModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Rider Information</h3>
                    <div class="mt-2">
                        <table id="riderInfoTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Populate with JavaScript -->
                        </table>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="approveForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Approve</button>
                    </form>
                    <form id="declineForm" method="POST" action="" class="mt-3 sm:mt-0 sm:ml-3">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Decline</button>
                    </form>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openModal(riderId) {
            // Fetch rider information using an AJAX call and populate the modal
            fetch(`/api/riders/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with rider data
                    const table = document.getElementById('riderInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">International Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Sex</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date of Birth</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_date_of_birth}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Country</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.country_name}</td></tr>
                    `;
                    // Set the action for the forms
                    document.getElementById('approveForm').action = `/club/approve/${riderId}`;
                    document.getElementById('declineForm').action = `/club/decline/${riderId}`;
                    // Show the modal
                    document.getElementById('riderModal').classList.remove('hidden');
                });
        }
    
        function closeModal() {
            document.getElementById('riderModal').classList.add('hidden');
        }
    </script>
    
</x-app-layout>

 --}}







{{--  
 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riders') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Riders for Approval</h3>
                        @if ($ridersForApproval->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">No riders awaiting approval.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rider Name</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($ridersForApproval as $rider)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $rider->rider_last_name }} {{ $rider->rider_first_names }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" onclick="openModal('{{ $rider->rider_id }}')">Review Rider Info</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Add New Rider</h3>
                        <form method="POST" action="{{ route('club.storeRider') }}" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
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
    </div>
    
    <!-- Modal -->
    <div id="riderModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Rider Information</h3>
                    <div class="mt-2">
                        <table id="riderInfoTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Populate with JavaScript -->
                        </table>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="approveForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Approve</button>
                    </form>
                    <form id="declineForm" method="POST" action="" class="mt-3 sm:mt-0 sm:ml-3">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Decline</button>
                    </form>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openModal(riderId) {
            // Fetch rider information using an AJAX call and populate the modal
            fetch(`/api/riders/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with rider data
                    const table = document.getElementById('riderInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">International Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Sex</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date of Birth</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_date_of_birth}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Country</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.country_name}</td></tr>
                    `;
                    // Set the action for the forms
                    document.getElementById('approveForm').action = `/club/approve/${riderId}`;
                    document.getElementById('declineForm').action = `/club/decline/${riderId}`;
                    // Show the modal
                    document.getElementById('riderModal').classList.remove('hidden');
                });
        }
    
        function closeModal() {
            document.getElementById('riderModal').classList.add('hidden');
        }
    </script>
    
</x-app-layout> --}}



{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riders for Approval') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Riders for Approval</h3>
                        @if ($ridersForApproval->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">No riders awaiting approval.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rider Name</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($ridersForApproval as $rider)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $rider->rider_last_name }} {{ $rider->rider_first_names }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" onclick="openModal('{{ $rider->rider_id }}')">Review Rider Info</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="container">        
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Registered Riders</h3>
                        <div id="ridersTableContainer">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th>番</th>
                                        <th>選手名</th>
                                        <th>フリガナ</th>
                                        <th>登録番号</th>
                                        <th>性別</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Existing riders will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button id="addRiderRow" class="addRowButton bg-blue-500 text-white px-4 py-2 rounded-md mt-4">追加</button>

                    <form method="POST" action="{{ route('club.storeRider') }}" class="space-y-4 mt-6 hidden" id="addRiderForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
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
    
    <!-- Modal -->
    <div id="riderModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Rider Information</h3>
                    <div class="mt-2">
                        <table id="riderInfoTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Populate with JavaScript -->
                        </table>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="approveForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Approve</button>
                    </form>
                    <form id="declineForm" method="POST" action="" class="mt-3 sm:mt-0 sm:ml-3">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Decline</button>
                    </form>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openModal(riderId) {
            // Fetch rider information using an AJAX call and populate the modal
            fetch(`/api/riders/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with rider data
                    const table = document.getElementById('riderInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">International Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Sex</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date of Birth</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_date_of_birth}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Country</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.country_name}</td></tr>
                    `;
                    // Set the action for the forms
                    document.getElementById('approveForm').action = `/club/approve/${riderId}`;
                    document.getElementById('declineForm').action = `/club/decline/${riderId}`;
                    // Show the modal
                    document.getElementById('riderModal').classList.remove('hidden');
                });
        }
    
        function closeModal() {
            document.getElementById('riderModal').classList.add('hidden');
        }

        document.getElementById('addRiderRow').addEventListener('click', function () {
            document.getElementById('addRiderForm').classList.remove('hidden');
        });
    </script>
    
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('選手管理') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">承認を待っている選手</h3>
                        @if ($ridersForApproval->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">承認を待っている選手はありません。</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rider Name</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($ridersForApproval as $rider)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $rider->rider_last_name }} {{ $rider->rider_first_names }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" onclick="openModal('{{ $rider->rider_id }}')">Review Rider Info</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">        
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Registered Riders</h3>
                        <div id="ridersTableContainer">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">番</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">選手名</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">フリガナ</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">登録番号</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">性別</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($registeredRiders as $rider)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $loop->index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $rider->rider_last_name }} {{ $rider->rider_first_names }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $rider->rider_last_name_furigana }} {{ $rider->rider_first_names_furigana }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $rider->rider_registration_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $rider->rider_sex }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                {{-- <button class="text-red-600 dark:text-red-400 hover:text-red-900" onclick="deleteRider('{{ $rider->rider_id }}')">削除</button> --}}
                                                <button class="text-red-600 dark:text-red-400 hover:text-red-900" onclick="confirmDeleteRider('{{ $rider->rider_id }}')">削除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button id="addRiderRow" class="addRowButton bg-blue-500 text-white px-4 py-2 rounded-md mt-4">追加</button>

                    <form method="POST" action="{{ route('club.storeRider') }}" class="space-y-4 mt-6 hidden" id="addRiderForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
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
    
    <!-- Modal -->
    <div id="riderModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Rider Information</h3>
                    <div class="mt-2">
                        <table id="riderInfoTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Populate with JavaScript -->
                        </table>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="approveForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Approve</button>
                    </form>
                    <form id="declineForm" method="POST" action="" class="mt-3 sm:mt-0 sm:ml-3">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Decline</button>
                    </form>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openModal(riderId) {
            // Fetch rider information using an AJAX call and populate the modal
            fetch(`/api/riders/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with rider data
                    const table = document.getElementById('riderInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">First Names Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Last Name Furigana</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">International Registration Number</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Sex</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date of Birth</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.rider_date_of_birth}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Country</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.country_name}</td></tr>
                    `;
                    // Set the action for the forms
                    document.getElementById('approveForm').action = `/club/approve/${riderId}`;
                    document.getElementById('declineForm').action = `/club/decline/${riderId}`;
                    // Show the modal
                    document.getElementById('riderModal').classList.remove('hidden');
                });
        }
    
        function closeModal() {
            document.getElementById('riderModal').classList.add('hidden');
        }

        document.getElementById('addRiderRow').addEventListener('click', function () {
            document.getElementById('addRiderForm').classList.remove('hidden');
        });

        // function confirmDeleteRider(riderId) {
        //     if (confirm('Are you sure you want to delete this rider?')) {
        //         deleteRider(riderId);
        //     }
        // }

        // function deleteRider(riderId) {
        //     // Your existing deleteRider function code
        //     fetch(`/club/deleteRider/${riderId}`, {
        //         method: 'DELETE',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //             'Content-Type': 'application/json'
        //         },
        //     }).then(response => {
        //         if (response.ok) {
        //             location.reload(); // Reload the page or update the DOM as necessary
        //         } else {
        //             alert('Failed to delete rider.');
        //         }
        //     });
        // }
        function confirmDeleteRider(riderId) {
            if (confirm('Are you sure you want to delete this rider?')) {
                deleteRider(riderId);
            }
        }

        function deleteRider(riderId) {
            fetch(`/club/riders/${riderId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
            }).then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page or update the DOM as necessary
                } else {
                    alert('Failed to delete rider.');
                }
            });
        }
    </script>
    
</x-app-layout>
