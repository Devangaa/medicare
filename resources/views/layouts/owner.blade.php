<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Owner Dashboard') — Medicare</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* SIDEBAR COLLAPSED STYLES */
        .sidebar-collapsed {
            width: 90px !important;
            padding: 1rem 0.5rem !important;
        }
        
        .sidebar-collapsed .sidebar-text {
            display: none !important;
        }
        
        .sidebar-collapsed .brand-logo-text {
            display: none !important;
        }
        
        .sidebar-collapsed .menu-label {
            display: none !important;
        }
        
        /* Logo button collapsed */
        .sidebar-collapsed #sidebar-logo-toggle {
            justify-content: center !important;
            padding: 0.75rem !important;
            gap: 0 !important;
            position: relative;
        }

        .sidebar-collapsed #sidebar-logo-toggle .flex {
            margin: 0 !important;
        }

        /* SEMBUNYIKAN PANAH SAAT COLLAPSED */
        .sidebar-collapsed #sidebar-toggle-icon {
            display: none !important;
        }

        /* default collapsed = tampil heart */
        .sidebar-collapsed #heart-icon {
            opacity: 1;
            transform: scale(1);
        }

        .sidebar-collapsed #arrow-icon {
            opacity: 0;
            transform: scale(0.75);
        }

        .sidebar-collapsed #heart-icon,
        .sidebar-collapsed #arrow-icon {
            transition:
                opacity .25s ease,
                transform .25s ease;
        }


        /* hover = heart berubah jadi arrow */
        .sidebar-collapsed #sidebar-logo-toggle:hover #heart-icon {
            opacity: 0;
            transform: scale(0.75);
        }

        .sidebar-collapsed #sidebar-logo-toggle:hover #arrow-icon {
            opacity: 1;
            transform: scale(1);
        }

        /* TAMPILKAN SAAT HOVER */
        .sidebar-collapsed #sidebar-logo-toggle:hover #sidebar-toggle-icon {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }
        
        /* Menu items collapsed - centered */
        .sidebar-collapsed .menu-item {
            justify-content: center !important;
            padding: 0.75rem !important;
            gap: 0 !important;
            position: relative;
        }
        
        .sidebar-collapsed .menu-item:hover::after {
            content: attr(data-label);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 0.75rem;
            background: rgba(30, 41, 59, 0.95);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            white-space: nowrap;
            border: 1px solid rgb(71, 85, 105, 0.5);
            z-index: 100;
            pointer-events: none;
            animation: slideIn 0.2s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(-0.5rem);
            }
            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }
        
        .sidebar-collapsed .menu-item i {
            margin: 0 !important;
            width: auto !important;
        }
        
        /* Sidebar spacing */
        .sidebar-collapsed > div {
            gap: 1rem !important;
        }
        
        .sidebar-collapsed nav {
            gap: 0.75rem !important;
        }
        
        /* Footer section collapsed */
        .sidebar-collapsed > .bg-slate-900\/60 {
            padding: 0.75rem !important;
            font-size: 0.7rem;
        }

        @media (max-width: 768px) {
            .sidebar-mobile {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                width: 256px !important;
            }
            .sidebar-mobile.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-[#090d16] text-slate-200 min-h-screen flex">

    <!-- SIDEBAR KIRI -->
    <aside id="sidebar" class="sidebar-mobile md:relative w-64 bg-[#0f172a] border-r border-slate-800 flex flex-col justify-between p-5 md:flex shrink-0 transition-all duration-300">
        <div class="space-y-8">
            <!-- Brand Logo Medicare - Toggle Button (Desktop Collapse) -->
            <button id="sidebar-logo-toggle"
                class="hidden md:flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-slate-800/40 transition-colors group w-full text-left">

                <div id="logo-container"
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600/20 text-blue-400 border border-blue-500/30 shrink-0 relative overflow-hidden">

                    <i id="heart-icon"
                        class="fa-solid fa-heart-pulse text-lg absolute transition-all duration-300"></i>

                    <i id="arrow-icon"
                        class="fa-solid fa-chevron-right text-lg absolute opacity-0 scale-75 transition-all duration-300"></i>

                </div>

                <span class="brand-logo-text text-lg font-bold tracking-widest text-white uppercase flex-1 min-w-0">
                    Medicare
                </span>

                <i id="sidebar-toggle-icon"
                    class="fa-solid fa-chevron-left w-5 text-slate-400 group-hover:text-slate-200 transition-colors shrink-0"></i>
            </button>

            <!-- Brand Logo Medicare - Mobile Close Button -->
            <button id="sidebar-logo-toggle-mobile" class="md:hidden flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-slate-800/40 transition-colors group w-full text-left">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600/20 text-blue-400 border border-blue-500/30 shrink-0">
                    <i class="fa-solid fa-heart-pulse text-lg animate-pulse"></i>
                </div>
                <span class="text-lg font-bold tracking-widest text-white uppercase flex-1 min-w-0">Medicare</span>
                <!-- Close Icon Mobile -->
                <i class="fa-solid fa-times w-5 text-slate-400 group-hover:text-slate-200 transition-colors shrink-0"></i>
            </button>

            <!-- Menu Navigasi -->
            <nav class="space-y-1.5">
                <p class="menu-label text-[10px] font-bold uppercase tracking-widest text-slate-500 px-2 mb-3">Menu Utama</p>
                
                <!-- Dashboard -->
                <a href="{{ url('/owner/dashboard') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::is('owner/dashboard*') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}" data-icon="fa-chart-pie" data-label="Dashboard">
                    <i class="fa-solid fa-chart-pie w-5 shrink-0"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <!-- Data Staff -->
                <a href="{{ url('/owner/staff') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::is('owner/staff*') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}" data-icon="fa-users" data-label="Data Staff">
                    <i class="fa-solid fa-users w-5 shrink-0"></i>
                    <span class="sidebar-text">Data Staff</span>
                </a>

                <!-- Data Obat -->
                <a href="{{ url('/owner/obat') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::is('owner/obat*') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}" data-icon="fa-pills" data-label="Data Obat">
                    <i class="fa-solid fa-pills w-5 shrink-0"></i>
                    <span class="sidebar-text">Data Obat</span>
                </a>

                <!-- Transaksi -->
                <a href="{{ url('/owner/transaksi') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::is('owner/transaksi*') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}" data-icon="fa-wallet" data-label="Transaksi">
                    <i class="fa-solid fa-wallet w-5 shrink-0"></i>
                    <span class="sidebar-text">Transaksi</span>
                </a>

                <!-- Pembelian Obat -->
                <a href="{{ url('/owner/pembelian') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::is('owner/pembelian*') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}" data-icon="fa-cart-shopping" data-label="Pembelian Obat">
                    <i class="fa-solid fa-cart-shopping w-5 shrink-0"></i>
                    <span class="sidebar-text">Pembelian Obat</span>
                </a>

                <!-- Pembuangan Obat -->
                <a href="{{ url('/owner/pembuangan') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::is('owner/pembuangan*') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}" data-icon="fa-trash-can" data-label="Pembuangan Obat">
                    <i class="fa-solid fa-trash-can w-5 shrink-0"></i>
                    <span class="sidebar-text">Pembuangan Obat</span>
                </a>
            </nav>
        </div>


    </aside>

    <!-- AREA KONTEN UTAMA (Kanan) -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- NAVBAR ATAS -->
        <header class="h-20 bg-[#0f172a]/80 backdrop-blur-md border-b border-slate-800 px-4 sm:px-6 md:px-8 flex items-center justify-between sticky top-0 z-40">
            
            <!-- Sisi Kiri Navbar: Hamburger (Mobile) + Ikon & Nama Halaman -->
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <!-- Hamburger Button (Mobile Only) -->
                <button id="hamburger-mobile" class="md:hidden text-slate-400 hover:text-slate-200 transition-colors p-1.5 rounded-lg hover:bg-slate-800/40">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <!-- Ikon & Nama Halaman -->
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <div id="navbar-page-icon" class="text-slate-400 bg-slate-800/40 p-2 rounded-lg border border-slate-700/50 shrink-0">
                        <i class="fa-solid fa-circle"></i>
                    </div>
                    <h2 id="navbar-page-name" class="text-sm sm:text-lg font-bold text-white tracking-wide truncate">
                        Dashboard
                    </h2>
                </div>
            </div>

            <!-- Sisi Kanan Navbar: Profil Akun Clickable dengan Dropdown -->
            <div class="relative shrink-0">
                <button id="profile-dropdown-btn" class="cursor-pointer flex items-center gap-2 sm:gap-3 p-1.5 pr-2 sm:pr-3 rounded-xl bg-slate-800/40 border border-slate-800 hover:border-slate-700/80 transition-all focus:outline-none select-none">
                    <!-- Foto Profil -->
                    <img class="h-8 sm:h-9 w-8 sm:w-9 rounded-lg object-cover bg-slate-700 border border-slate-600" 
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap ?? 'Owner') }}&background=2563eb&color=fff" 
                         alt="Foto Profil">
                    <!-- Nama User (Hidden di layar HP kecil) -->
                    <span class="text-xs sm:text-sm font-semibold text-slate-200 hidden sm:inline max-w-[100px] sm:max-w-[120px] truncate">
                        {{ Auth::user()->nama_lengkap ?? 'Owner Medicare' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200" id="chevron-icon"></i>
                </button>

                <!-- DROPDOWN MENU -->
                <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 sm:w-52 rounded-2xl bg-[#0f172a] border border-slate-800 shadow-2xl p-2 z-50 animate-fade-in">
                    <!-- Menu Profile Saya -->
                    <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white rounded-xl transition-colors">
                        <i class="fa-regular fa-user w-4 text-slate-400"></i>
                        <span>Profil Saya</span>
                    </a>
                    
                    <hr class="border-slate-800 my-1">
                    
                    <!-- Menu Logout -->
                    <form action="{{ url('/logout') }}" method="POST" class="block w-full">
                        @csrf
                        <button type="submit" class="cursor-pointer flex w-full items-center gap-3 px-3 py-2.5 text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-xl transition-colors text-left focus:outline-none">
                            <i class="fa-solid fa-arrow-right-from-bracket w-4"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- ISI KONTEN UTAMA (Yang akan diisi oleh view dashboard) -->
        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- OVERLAY SIDEBAR MOBILE -->
    <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/50 z-40 md:hidden"></div>

    <!-- LOGIK JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarLogoToggle = document.getElementById('sidebar-logo-toggle');
            const sidebarLogoToggleMobile = document.getElementById('sidebar-logo-toggle-mobile');
            const hamburgerMobile = document.getElementById('hamburger-mobile');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const navbarPageIcon = document.getElementById('navbar-page-icon');
            const navbarPageName = document.getElementById('navbar-page-name');
            const menuItems = document.querySelectorAll('.menu-item');

            // ========== DESKTOP: LOGO TOGGLE FOR COLLAPSE/EXPAND ==========
            sidebarLogoToggle.addEventListener('click', function () {
                sidebar.classList.toggle('sidebar-collapsed');
            });

            // ========== MOBILE: HAMBURGER BUTTON TO OPEN SIDEBAR ==========
            hamburgerMobile.addEventListener('click', function () {
                sidebar.classList.add('open');
                sidebarOverlay.classList.remove('hidden');
            });

            // ========== MOBILE: LOGO TOGGLE TO CLOSE SIDEBAR ==========
            sidebarLogoToggleMobile.addEventListener('click', function () {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.add('hidden');
            });

            // ========== CLOSE SIDEBAR WHEN CLICKING OVERLAY ==========
            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.add('hidden');
            });

            // ========== UPDATE NAVBAR ICON KETIKA MENU DIPILIH ==========
            function updateNavbarIcon() {
                const activeMenuItem = document.querySelector('.menu-item.bg-slate-800');
                if (activeMenuItem) {
                    const iconClass = activeMenuItem.dataset.icon;
                    const label = activeMenuItem.dataset.label;
                    
                    navbarPageIcon.innerHTML = `<i class="fa-solid ${iconClass}"></i>`;
                    navbarPageName.textContent = label;
                }
            }

            // Update navbar icon on page load
            updateNavbarIcon();

            // Update navbar icon when clicking menu items
            menuItems.forEach(item => {
                item.addEventListener('click', function () {
                    setTimeout(updateNavbarIcon, 100);
                });
            });

            // ========== DROPDOWN PROFILE ==========
            const btn = document.getElementById('profile-dropdown-btn');
            const menu = document.getElementById('profile-dropdown-menu');
            const chevron = document.getElementById('chevron-icon');

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
                chevron.classList.toggle('rotate-180');
            });

            document.addEventListener('click', function (e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }
            });

            // ========== CLOSE SIDEBAR MOBILE AFTER MENU CLICK ==========
            menuItems.forEach(item => {
                item.addEventListener('click', function () {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('open');
                        sidebarOverlay.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>