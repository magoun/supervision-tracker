<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>

                @php
                    $totalHours = Auth::user()->totalHours();
                    $groupHours = Auth::user()->groupHours();
                    $individualHours = $totalHours - $groupHours;
                    $individualPercentage = $individualHours * (100 / 50);
                @endphp
                
                <ul class="p-6">
                    <li>
                        <strong>Most recent supervision date: </strong>
                        {{ Auth::user()->lastSession()->date }}
                    </li>
                    <li>
                        <strong>Total Hours: </strong>
                        {{ "$totalHours ($totalHours%)" }}
                        @if($totalHours > 100)
                            <i class="fas fa-check text-green-600 fa-lg"></i>
                        @endif
                    </li>
                    <li>
                        <strong>Individual Hours: </strong>
                        {{ "$individualHours ($individualPercentage%)" }}
                        @if($individualHours > 50)
                            <i class="fas fa-check text-green-600 fa-lg"></i>
                        @endif
                    </li>
                    <li>
                        <strong>Group Hours: </strong>
                        {{ $groupHours }}
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</x-app-layout>
