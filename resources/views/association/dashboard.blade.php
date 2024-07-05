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
                    {{ __("You are the ASSOCIATION organizing an event") }}
                </div>
                <div class="container">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Clubs for Approval</h3>
                        @if ($clubsForApproval->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">No clubs awaiting approval.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Club Name</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($clubsForApproval as $club)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $club->club_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" onclick="openModal('{{ $club->club_id }}')">Review Club Info</button>
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
    <div id="clubModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Club Information</h3>
                    <div class="mt-2">
                        <table id="clubInfoTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
        function openModal(clubId) {
            // Fetch club information using an AJAX call and populate the modal
            fetch(`/api/clubs/${clubId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with club data
                    const table = document.getElementById('clubInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Club Name</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Registration Officer</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_registration_officer}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Mobile</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_mobile}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Phone</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_phone}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Fax</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_fax}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Address</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_address}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Country</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.country_name}</td></tr>
                    `;
                    // Set the action for the forms
                    document.getElementById('approveForm').action = `/association/approve/${clubId}`;
                    document.getElementById('declineForm').action = `/association/decline/${clubId}`;
                    // Show the modal
                    document.getElementById('clubModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('clubModal').classList.add('hidden');
        }
    </script>
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
                    {{ __("You are an ASSOCIATION admin") }}
                </div>
                <div class="container">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Clubs for Approval</h3>
                        @if ($clubsForApproval->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">No clubs awaiting approval.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Club Name</th>
                                        <th class="px-6 py-3 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($clubsForApproval as $club)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $club->club_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" onclick="openClubModal('{{ $club->club_id }}')">Review Club Info</button>
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
    
    <!-- Club Modal -->
    <div id="clubModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Club Information</h3>
                    <div class="mt-2">
                        <table id="clubInfoTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeClubModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openClubModal(clubId) {
            fetch(`/api/clubs/${clubId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with club data
                    const table = document.getElementById('clubInfoTable');
                    table.innerHTML = `
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Club Name</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Registration Officer</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_registration_officer}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Mobile</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_mobile}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Phone</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_phone}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Fax</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_fax}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Address</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.club_address}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Country</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.country_name}</td></tr>
                        <tr><th class="px-6 py-4 text-gray-900 dark:text-gray-100">Association</th><td class="px-6 py-4 text-gray-900 dark:text-gray-100">${data.association_name}</td></tr>
                    `;
                    // Set the action for the forms
                    document.getElementById('approveForm').action = `/association/approve/${clubId}`;
                    document.getElementById('declineForm').action = `/association/decline/${clubId}`;
                    // Show the modal
                    document.getElementById('clubModal').classList.remove('hidden');
                });
        }

        function closeClubModal() {
            document.getElementById('clubModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
