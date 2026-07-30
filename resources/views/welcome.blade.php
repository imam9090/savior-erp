<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Savior ERP') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50">

    <!-- Navbar -->
<header class="bg-slate-900">
    <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
        <div class="flex items-center gap-2">
            <x-application-logo class="h-8 w-auto fill-current text-orange-400" />
            <span class="font-semibold text-white text-lg">Savior ERP</span>
        </div>

        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
                        Masuk
                    </a>
                @endauth
            </nav>
        @endif
    </div>
</header>

    <!-- Hero -->
    <section class="max-w-6xl mx-auto px-6 pt-12 pb-20 text-center">
        <span class="inline-block bg-orange-50 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">
            Sistem Internal Savior Prime Indonesia
        </span>
        <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 leading-tight">
            Satu Sistem untuk<br>
            <span class="text-orange-500">Seluruh Operasional Perusahaan</span>
        </h1>
        <p class="text-slate-500 mt-5 max-w-xl mx-auto">
            Kelola absensi, komunikasi tim, diskusi proyek, dan invoicing klien dalam satu platform terintegrasi.
        </p>
        <div class="mt-8">
            <a href="{{ route('login') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-medium px-8 py-3 rounded-xl transition-colors shadow-sm shadow-orange-200">
                Masuk ke Sistem
            </a>
        </div>
    </section>

    <!-- Fitur -->
    <section class="max-w-6xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border border-slate-100 rounded-2xl p-6">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="font-semibold text-slate-800 mb-1">Absensi</h3>
                <p class="text-sm text-slate-500">Clock in/out digital dan riwayat kehadiran karyawan.</p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" /></svg>
                </div>
                <h3 class="font-semibold text-slate-800 mb-1">Diskusi Proyek</h3>
                <p class="text-sm text-slate-500">Forum diskusi per klien dan proyek untuk koordinasi tim.</p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </div>
                <h3 class="font-semibold text-slate-800 mb-1">Pesan</h3>
                <p class="text-sm text-slate-500">Komunikasi langsung antar tim dan klien secara real-time.</p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <h3 class="font-semibold text-slate-800 mb-1">Invoicing</h3>
                <p class="text-sm text-slate-500">Pembuatan invoice otomatis lengkap dengan perhitungan PPN & PPh.</p>
            </div>
        </div>
    </section>

    <!-- Info Perusahaan -->
    <section class="bg-white border-t border-slate-100">
        <div class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                    Tentang Kami
                </span>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Savior Prime Indonesia</h2>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Savior Prime Indonesia adalah perusahaan konsultan bisnis dan keuangan yang didirikan pada tahun 2022.
                    Kami menyediakan layanan Virtual CFO, akuntansi, perpajakan, hukum, dan penasihat keuangan untuk
                    membantu mengelola dan mengembangkan bisnis klien secara digital, aman, efisien, dan efektif.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Sebagai <em>One Stop Business Solution</em>, kami berkomitmen menjadi mitra terpercaya dalam
                    setiap langkah pertumbuhan bisnis Anda.
                </p>
            </div>

            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 space-y-5">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <svg class="h-4 w-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800">Alamat</p>
                        <p class="text-sm text-slate-500">BSB Boulevard, Semarang, Jawa Tengah</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <svg class="h-4 w-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800">Kontak</p>
                        <p class="text-sm text-slate-500">cs@saviorbetterfuture.com</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <svg class="h-4 w-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800">Layanan</p>
                        <p class="text-sm text-slate-500">Virtual CFO, Akuntansi, Pajak, Hukum, Advisory Keuangan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto px-6 py-8 text-center">
        <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Savior Prime Indonesia. Semua hak dilindungi.</p>
    </footer>

</body>
</html>