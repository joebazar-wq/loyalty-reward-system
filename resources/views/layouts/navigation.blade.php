@php
    $role = auth()->user()->role;
@endphp

<nav class="relative bg-gray-800">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">

      <!-- Mobile menu button -->
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
          <span class="sr-only">Open main menu</span>
          <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>

      <!-- Logo and menu links -->
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
<div class="flex shrink-0 items-center">
    {{-- <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-white text-sm font-bold"> --}}
      <a href="
{{ 
    auth()->user()->role === 'admin' ? route('admin.dashboard') :
    (auth()->user()->role === 'staff' ? route('staff.dashboard') : route('dashboard'))
}}"
class="flex items-center space-x-2 text-white text-sm font-bold">

        <!-- SVG Logo -->
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="48"
            height="48"
            viewBox="0 0 24 24"
            fill="none"
            stroke="yellow"
            stroke-width="1"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="text-white"
        >
            <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
            <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
            <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
        </svg>

        <!-- Text -->
        <span>LOYALTY REWARD SYSTEM</span>
    </a>
</div>


    <div class="hidden sm:ml-6 sm:flex">
        <div class="flex space-x-4 justify-center items-center">
            @if($role === 'user')
  
        <a href="{{ route('dashboard') }}" 
        class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                category: Buildings
                tags: [house, dashboard, living, building]
                version: "1.0"
                unicode: "eac1"
                -->
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                >
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            Dashboard
        </a>

        <a href="{{ route('rewards.index') }}" 
        class="flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium
                {{ request()->routeIs('rewards.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="text-white"
                >
                    <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                    <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
                    <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                </svg>
            Rewards
        </a>

        <a href="{{ route('rewards.history') }}"
        class="flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium
        {{ request()->routeIs('rewards.history') 
                ? 'bg-gray-900 text-white' 
                : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                    <!--
                    tags: [simple, time, timer, clock, sand]
                    version: "1.60"
                    category: System
                    unicode: "f092"
                    -->
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#fff"
                    stroke-width="1"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M6.5 7h11" />
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                    </svg>


            History
        </a>

        <a href="{{ route('profile.edit') }}"
        class="flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium
        {{ request()->routeIs('profile.edit') 
                ? 'bg-gray-900 text-white' 
                : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                    <!--
                    tags: [contact, contacts, phonebook, profile, resources]
                    version: "1.55"
                    unicode: "f021"
                    -->
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#fff"
                    stroke-width="1"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                    <path d="M10 16h6" />
                    <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M4 8h3" />
                    <path d="M4 12h3" />
                    <path d="M4 16h3" />
                    </svg>
                Profile
        </a>

        <a href="{{ route('shop') }}"
        class="flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium
        {{ request()->routeIs('shop') 
                ? 'bg-gray-900 text-white' 
                : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                category: E-commerce
                tags: [shop, store, online, shopping]
                version: "1.7"
                unicode: "ebe1"
                -->
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                >
                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M5.001 8h13.999a2 2 0 0 1 1.977 2.304l-1.255 7.152a3 3 0 0 1 -2.966 2.544h-9.512a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304z" />
                <path d="M17 10l-2 -6" />
                <path d="M7 10l2 -6" />
                </svg>

                Shop
        </a>


              {{-- <a href="{{ route('history') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Purchase History</a> --}}

            @elseif($role === 'staff')
              {{-- <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
              <a href="{{ route('staff') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Staff</a>
              <a href="{{ route('reports') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reports</a>
              <a href="{{ route('settings') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Settings</a> --}}
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                category: Buildings
                tags: [house, dashboard, living, building]
                version: "1.0"
                unicode: "eac1"
                -->
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                >
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            Dashboard
        </a>
          <a href="{{ route('admin.rewards') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('admin.rewards') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>
            Redemptions
          </a>
          <a href="{{ route('orders.customer-orders') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('orders.customer-orders') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>
            Orders
          </a>
          <a href="{{ route('products.index') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('products.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>
            Products
          </a>

            @elseif($role === 'admin')
              {{-- <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
              <a href="{{ route('staff') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Staff</a>
              <a href="{{ route('reports') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reports</a>
              <a href="{{ route('settings') }}" class="text-gray-300 hover:bg-white/5 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Settings</a> --}}
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                category: Buildings
                tags: [house, dashboard, living, building]
                version: "1.0"
                unicode: "eac1"
                -->
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                >
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            Dashboard
        </a>
          <a href="{{ route('admin.users.index') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('admin.users.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>

            Users
          </a>
          <a href="{{ route('admin.rewards') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('admin.rewards') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>
            Redemptions
          </a>
          <a href="{{ route('orders.customer-orders') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('orders.customer-orders') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>
            Orders
          </a>
          <a href="{{ route('products.index') }}" 
                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium
                {{ request()->routeIs('products.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <!--
                tags: [contact, contacts, phonebook, profile, resources]
                version: "1.55"
                unicode: "f021"
                -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#fff"
                  stroke-width="1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                  <path d="M10 16h6" />
                  <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M4 8h3" />
                  <path d="M4 12h3" />
                  <path d="M4 16h3" />
                </svg>
            Products
          </a>
            @endif
          </div>
        </div>
      </div>

@php
    $role = auth()->user()->role;
@endphp

<!-- Right-side: Remaining points & profile -->
<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

    @if($role === 'user')
        <div class="text-white mr-4 flex items-center space-x-2">
            <!-- money icon -->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
            </svg>

            <span class="font-semibold" style="font-size: 14px;">Balance:</span>
            {{-- <span>{{ \App\Services\PointsService::getBalances(Auth::id())['remainingBalances'] }}</span> --}}
            <span class="font-semibold text-white">{{ auth()->user()->loyalty_points }}</span>
        </div>
    @endif

    <!-- Profile dropdown -->
    <!-- <el-dropdown class="relative ml-2">
        <button class="relative flex rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            <span class="sr-only">Open user menu</span>
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="" class="size-8 rounded-full"/>
        </button>

        <el-menu anchor="bottom end" popover class="absolute right-0 top-full mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Sign out
                </button>
            </form>
        </el-menu>
    </el-dropdown>

</div> -->


        <!-- Profile dropdown -->
        <el-dropdown class="relative ml-2">
          <button class="relative flex rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            <span class="sr-only">Open user menu</span>
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="" class="size-8 rounded-full"/>
          </button>
          <el-menu anchor="bottom end" popover class="absolute right-0 top-full mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your profile</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</button>
            </form>
          </el-menu>
        </el-dropdown>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <el-disclosure id="mobile-menu" hidden class="block sm:hidden">
    <div class="space-y-1 px-2 pt-2 pb-3">
      @if($role === 'user')
        <a href="{{ route('dashboard') }}" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
        {{-- <a href="{{ route('rewards') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Rewards</a>
        <a href="{{ route('history') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Purchase History</a> --}}

      @elseif($role === 'staff')
        {{-- <a href="{{ route('dashboard') }}" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
        <a href="{{ route('users') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Users</a>
        <a href="{{ route('transactions') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Transactions</a> --}}

      @elseif($role === 'admin')
        {{-- <a href="{{ route('dashboard') }}" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
        <a href="{{ route('staff') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Staff</a>
        <a href="{{ route('reports') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Reports</a>
        <a href="{{ route('settings') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Settings</a> --}}
      @endif
    </div>
  </el-disclosure>
</nav>
