<x-app-layout>
{{-- <div class="card bg-gray-300 bg-base-100 shadow-md mt-10 mx-12 rounded-md">
  <div class="card-body p-6 m-4">
    <h2 class="card-title font-bold">Hi {{ auth()->user()->name }},</h2>
    <p class="mt-2">Welcome to your dashboard! You are Logged in as <b>{{ auth()->user()->role }}</b></p>
  </div>
</div> --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }} Your role is a
                    {{ auth()->user()->role }}

                    <p>Points: {{ $account->points }}</p>

                    @foreach($transactions as $t)
                        <p>{{ $t->type }} : {{ $t->points }}</p>
                    @endforeach

                </div>
            </div>
        </div>
    </div> --}}
<div class="flex w-full mt-5">
    <div class="w-1/2 bg-neutral-100 card bg-base-100 shadow-md mt-5 ml-12 mr-3 rounded-md">
        <div class="card-body p-6 m-4">
            <h2 class="card-title font-bold">Hi {{ auth()->user()->name }},</h2>
            <p class="mt-2">Welcome to your dashboard! You are Logged in as <b>{{ auth()->user()->role }}</b></p>
        </div>
    </div>

    <div class="w-1/2 bg-neutral-100 card bg-base-100 shadow-md mt-5 mr-12 ml-3 rounded-md">
        <div class="card-body p-6 m-4">
            <h2 class="card-title font-bold">Hi {{ auth()->user()->name }},</h2>
            <p class="mt-2">Welcome to your dashboard! You are Logged in as <b>{{ auth()->user()->role }}</b></p>
        </div>
    </div>
</div>


</x-app-layout>







