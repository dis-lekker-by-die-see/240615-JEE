{{-- <x-app-layout>
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
                <div class="container">
                    
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> --}}
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
                    {{ __("You are a CLUB admin") }}
                </div>
                <div class="container">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Riders for Approval</h3>
                    <ul>
                        @foreach($ridersForApproval as $rider)
                            <li class="flex justify-between items-center my-2">
                                {{ $rider->rider_last_name }} {{ $rider->rider_first_names }}
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md" onclick="showRiderInfo({{ $rider->rider_id }})">Review Rider Info</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="riderModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200" id="modal-title">Rider Information</h3>
                            <div class="mt-2">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <!-- Table contents will be populated by JavaScript -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="approve-btn bg-green-500 text-white px-4 py-2 rounded-md mx-2">Approve</button>
                    <button type="button" class="decline-btn bg-red-500 text-white px-4 py-2 rounded-md mx-2">Decline</button>
                    <button type="button" class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-md mx-2" onclick="closeRiderInfo()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showRiderInfo(riderId) {
            fetch(`/club/rider-info/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    const table = document.querySelector('#riderModal table');
                    table.innerHTML = `
                        <tr><td>First Names</td><td>${data.rider_first_names}</td></tr>
                        <tr><td>First Names Furigana</td><td>${data.rider_first_names_furigana}</td></tr>
                        <tr><td>Last Name</td><td>${data.rider_last_name}</td></tr>
                        <tr><td>Last Name Furigana</td><td>${data.rider_last_name_furigana}</td></tr>
                        <tr><td>Registration Number</td><td>${data.rider_registration_number}</td></tr>
                        <tr><td>International Registration Number</td><td>${data.rider_international_registration_number}</td></tr>
                        <tr><td>Sex</td><td>${data.rider_sex}</td></tr>
                        <tr><td>Date of Birth</td><td>${data.rider_date_of_birth}</td></tr>
                        <tr><td>Country</td><td>${data.country_name}</td></tr>
                    `;
                    document.getElementById('riderModal').classList.remove('hidden');
                    document.querySelector('.approve-btn').setAttribute('onclick', `approveRider(${riderId})`);
                    document.querySelector('.decline-btn').setAttribute('onclick', `declineRider(${riderId})`);
                });
        }

        function closeRiderInfo() {
            document.getElementById('riderModal').classList.add('hidden');
        }

        function approveRider(riderId) {
            fetch(`/club/approve-rider/${riderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                closeRiderInfo();
                location.reload();
            });
        }

        function declineRider(riderId) {
            fetch(`/club/decline-rider/${riderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                closeRiderInfo();
                location.reload();
            });
        }
    </script>
</x-app-layout> --}}

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
                    {{ __("You are a CLUB admin") }}
                </div>
                <div class="container">

                    <!-- Riders for Approval Section -->
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200 mt-6">Riders for Approval</h3>
                    <div class="mt-4">
                        @foreach ($ridersForApproval as $rider)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow mb-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        {{ $rider->rider_last_name }} {{ $rider->rider_first_names }}
                                    </div>
                                    <div>
                                        <button onclick="openModal({{ $rider->rider_id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Review Rider Info
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Rider Info Modal -->
                    <div id="rider-info-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200 mb-4">Rider Information</h3>
                                <table class="table-auto w-full mb-4">
                                    <tbody id="rider-info-content">
                                        <!-- Rider info will be loaded here via JavaScript -->
                                    </tbody>
                                </table>
                                <div class="flex justify-end space-x-4">
                                    <form method="POST" action="" id="approve-form">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                                    </form>
                                    <form method="POST" action="" id="decline-form">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Decline</button>
                                    </form>
                                    <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(riderId) {
            // Fetch rider info and populate the modal content
            fetch(`/api/rider/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    const riderInfoContent = document.getElementById('rider-info-content');
                    riderInfoContent.innerHTML = `
                        <tr><td>First Names:</td><td>${data.rider_first_names}</td></tr>
                        <tr><td>Last Name:</td><td>${data.rider_last_name}</td></tr>
                        <tr><td>Sex:</td><td>${data.rider_sex}</td></tr>
                        <tr><td>Date of Birth:</td><td>${data.rider_date_of_birth}</td></tr>
                        <!-- Add other fields as necessary -->
                    `;

                    document.getElementById('approve-form').action = `/club/approve/${riderId}`;
                    document.getElementById('decline-form').action = `/club/decline/${riderId}`;

                    document.getElementById('rider-info-modal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('rider-info-modal').classList.add('hidden');
        }
    </script>
</x-app-layout> --}}

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
                    {{ __("You are a CLUB admin") }}
                </div>
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
                                            <td class="px-6 py-4 whitespace-nowrap">
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
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Cancel</button>
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
                        <tr><th class="px-6 py-4">First Names</th><td class="px-6 py-4">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4">First Names Furigana</th><td class="px-6 py-4">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4">Last Name</th><td class="px-6 py-4">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4">Last Name Furigana</th><td class="px-6 py-4">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4">Registration Number</th><td class="px-6 py-4">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4">International Registration Number</th><td class="px-6 py-4">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4">Sex</th><td class="px-6 py-4">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4">Date of Birth</th><td class="px-6 py-4">${data.rider_date_of_birth}</td></tr>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You are a CLUB admin") }}
                </div>
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
                                            <td class="px-6 py-4 whitespace-nowrap">
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
    </div> --}}

    {{-- <script>
        function openModal(riderId) {
            // Fetch rider information using an AJAX call and populate the modal
            fetch(`/api/riders/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with rider data
                    const table = document.getElementById('riderInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4">First Names</th><td class="px-6 py-4">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4">First Names Furigana</th><td class="px-6 py-4">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4">Last Name</th><td class="px-6 py-4">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4">Last Name Furigana</th><td class="px-6 py-4">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4">Registration Number</th><td class="px-6 py-4">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4">International Registration Number</th><td class="px-6 py-4">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4">Sex</th><td class="px-6 py-4">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4">Date of Birth</th><td class="px-6 py-4">${data.rider_date_of_birth}</td></tr>
                    `;
                    //<tr><th class="px-6 py-4">Country</th><td class="px-6 py-4">${data.country_name}</td></tr>
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
    </script> --}}
    {{-- <script>
        function openModal(riderId) {
            // Fetch rider information using an AJAX call and populate the modal
            fetch(`/api/riders/${riderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with rider data
                    const table = document.getElementById('riderInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4">First Names</th><td class="px-6 py-4">${data.rider_first_names}</td></tr>
                        <tr><th class="px-6 py-4">First Names Furigana</th><td class="px-6 py-4">${data.rider_first_names_furigana}</td></tr>
                        <tr><th class="px-6 py-4">Last Name</th><td class="px-6 py-4">${data.rider_last_name}</td></tr>
                        <tr><th class="px-6 py-4">Last Name Furigana</th><td class="px-6 py-4">${data.rider_last_name_furigana}</td></tr>
                        <tr><th class="px-6 py-4">Registration Number</th><td class="px-6 py-4">${data.rider_registration_number}</td></tr>
                        <tr><th class="px-6 py-4">International Registration Number</th><td class="px-6 py-4">${data.rider_international_registration_number}</td></tr>
                        <tr><th class="px-6 py-4">Sex</th><td class="px-6 py-4">${data.rider_sex}</td></tr>
                        <tr><th class="px-6 py-4">Date of Birth</th><td class="px-6 py-4">${data.rider_date_of_birth}</td></tr>
                        <tr><th class="px-6 py-4">Country</th><td class="px-6 py-4">${data.country_name}</td></tr>
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
    </script> --}}
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You are a CLUB admin") }}
                </div>
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
