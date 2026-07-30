<div x-data="{ open: false }">
    <!-- Mobile top bar -->
    <div class="lg:hidden flex items-center justify-between bg-slate-900 px-4 py-3 sticky top-0 z-30">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <img src="{{ asset('logo.JPG') }}" alt="Savior ERP" class="h-8 w-auto">
            <span class="font-semibold text-white">Savior ERP</span>
        </a>
        <button @click="open = ! open" class="p-2 rounded-lg text-slate-300 hover:bg-slate-800">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside
        :class="{'translate-x-0': open, '-translate-x-full': ! open}"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 flex flex-col transition-transform duration-200 -translate-x-full lg:translate-x-0"
    >
        <div class="h-16 flex items-center gap-2 px-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('logo.JPG') }}" alt="Savior ERP" class="h-8 w-auto">
                <span class="font-semibold text-white">Savior ERP</span>
            </a>
        </div>

        <div class="px-6 pb-5 flex items-center gap-3 border-b border-slate-800">
            <div class="w-11 h-11 rounded-full bg-slate-800 text-white flex items-center justify-center text-sm font-semibold flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            @foreach ([
    ['dashboard', 'dashboard', 'Dashboard', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
    ['projects.index', 'projects.*|forum.*|discussion.*', 'Proyek', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5'],
    ['attendance', 'attendance', 'Absensi', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
    ['attendance.history', 'attendance.history', 'Riwayat Absensi', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
] as [$route, $pattern, $label, $icon])
                @php $active = request()->routeIs(explode('|', $pattern)); @endphp
                <a href="{{ route($route) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-orange-500 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $icon }}" />
                    </svg>
                    {{ __($label) }}
                </a>
            @endforeach

            @if (auth()->user()->role->value === 'admin' || auth()->user()->role->value === 'superadmin')
                @php $active = request()->routeIs('attendance.admin'); @endphp
                <a href="{{ route('attendance.admin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-orange-500 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                    </svg>
                    {{ __('Absensi Karyawan') }}
                </a>
            @endif

            @php $active = request()->routeIs('messages.*'); @endphp
            <a href="{{ route('messages.inbox') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-orange-500 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                {{ __('Pesan') }}
            </a>

            @if (auth()->user()->role->value !== 'admin_client')
    @php $active = request()->routeIs('invoices.*'); @endphp
    <a href="{{ route('invoices.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-orange-500 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        {{ __('Invoice') }}
    </a>
@endif

@if (in_array(auth()->user()->role->value, ['superadmin', 'admin_finance']))
    @php $active = request()->routeIs('products.*'); @endphp
    <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-orange-500 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        {{ __('Produk & Jasa') }}
    </a>
@endif

            @if (auth()->user()->role->value === 'admin' || auth()->user()->role->value === 'superadmin')
                @php $active = request()->routeIs('users.*'); @endphp
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-orange-500 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Kelola User') }}
                </a>
            @endif
        </nav>

        <div class="border-t border-slate-800 p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Log Out
                </a>
            </form>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Profile
            </a>
        </div>
    </aside>

    <!-- Overlay untuk mobile -->
    <div x-show="open" x-cloak @click="open = false" class="fixed inset-0 bg-black/30 z-30 lg:hidden"></div>
</div>