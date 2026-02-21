<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NIMBUS CMS - Content, controlled.')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .bg-grid-pattern {
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-300 overflow-x-hidden selection:bg-indigo-500/30 selection:text-indigo-200">
    
    <!-- Navbar -->
    <nav x-data="{ scrolled: false, mobileMenu: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="{'bg-slate-950/80 backdrop-blur-lg border-b border-white/10 shadow-lg shadow-black/50': scrolled, 'bg-transparent border-b border-transparent': !scrolled}"
         class="fixed top-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                    <span class="font-bold text-2xl tracking-tighter text-white">NIMBUS</span>
                </div>
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#features" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Features</a>
                    <a href="#workflow" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Workflow</a>
                    <a href="#security" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Security</a>
                    <a href="#pricing" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Pricing</a>
                    <a href="#faq" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">FAQ</a>
                </div>
                <!-- Desktop CTA -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white transition-all bg-indigo-600 rounded-full hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)]">
                            Open Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Log in</a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white transition-all bg-slate-800 border border-white/10 rounded-full hover:bg-slate-700 hover:border-white/20 shadow-lg">
                            Get Started
                        </a>
                    @endauth
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenu = !mobileMenu" class="text-slate-400 hover:text-white focus:outline-none">
                        <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-cloak class="md:hidden bg-slate-900 border-b border-white/10 absolute w-full left-0 origin-top">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="#features" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-lg">Features</a>
                <a href="#workflow" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-lg">Workflow</a>
                <a href="#security" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-lg">Security</a>
                <a href="#pricing" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-lg">Pricing</a>
                <a href="#faq" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-lg">FAQ</a>
                <div class="pt-4 mt-2 border-t border-white/10 flex flex-col space-y-3 px-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="w-full text-center px-5 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500">Open Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center px-5 py-3 text-sm font-semibold text-white bg-slate-800 border border-white/10 rounded-lg hover:bg-slate-700">Get Started</a>
                        <a href="{{ route('login') }}" class="w-full text-center px-5 py-3 text-sm font-medium text-slate-300 hover:text-white">Log in</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-white/10 pt-16 pb-8 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
                <div class="col-span-2 lg:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                        <span class="font-bold text-xl tracking-tight text-white">NIMBUS</span>
                    </div>
                    <p class="text-slate-400 text-sm max-w-xs leading-relaxed">
                        The premium CMS for modern teams. Build, manage, and scale your content operations with enterprise-grade architecture.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4 text-sm tracking-wider uppercase">Product</h3>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Changelog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Roadmap</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4 text-sm tracking-wider uppercase">Resources</h3>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">API Reference</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4 text-sm tracking-wider uppercase">Legal</h3>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} Nimbus CMS. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-slate-500 hover:text-white transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                    </a>
                    <a href="#" class="text-slate-500 hover:text-white transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
