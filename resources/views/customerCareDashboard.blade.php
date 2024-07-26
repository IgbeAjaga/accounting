<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    {{ __("You're logged in!") }}
                    <h1>This is Customer care dashboard!</h1>

                    <div class="flex flex-wrap justify-center mt-4 gap-4">
                        <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
                            <a href="{{ route('create.customer') }}" class="btn btn-primary w-full bg-blue-500 text-white py-2 px-4 rounded">Add New Customer</a>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
                            <a href="{{ route('allcustomers') }}" class="btn btn-primary w-full bg-green-500 text-white py-2 px-4 rounded">View All Customers</a>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
                            <a href="{{ route('deposit.form') }}" class="btn btn-primary w-full bg-red-500 text-white py-2 px-4 rounded">Make New Deposit</a>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
                            <a href="{{ route('alltransactions') }}" class="btn btn-primary w-full bg-yellow-500 text-white py-2 px-4 rounded">View All Transactions</a>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
                            <a href="{{ route('purchase.form') }}" class="btn btn-primary w-full bg-orange-500 text-white py-2 px-4 rounded">Make New Purchase</a>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
                            <a href="{{ route('profile.index') }}" class="btn btn-primary w-full bg-purple-500 text-white py-2 px-4 rounded">View All Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
