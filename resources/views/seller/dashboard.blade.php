<x-app3>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    You're logged in!
                    <h1 style="text-align: center"><strong>seller name: </strong>   <span style="color: blue">{{ Auth::guard('seller')->user()->name }}</span> </h1>
                    <h1 style="text-align: center"><strong>seller email: </strong>   <span style="color: blue">{{ Auth::guard('seller')->user()->email }}</span> </h1>

                </div>
            </div>
        </div>
    </div>
</x-app3>
