@extends('layouts.marketing')
@section('title', 'NIMBUS CMS - Content, controlled.')
@section('content')

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden items-center justify-center flex flex-col min-h-screen">
    <div class="absolute inset-0 bg-grid-pattern opacity-30 pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] md:w-[800px] h-[600px] bg-indigo-600/20 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[400px] md:w-[600px] h-[400px] bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none delay-1000 animate-pulse"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10 w-full">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-medium mb-8 backdrop-blur-sm">
            <span class="flex h-2 w-2 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span>
            Built on Laravel 12 + PHP 8.4
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter mb-6 leading-[1.1]">
            <span class="block text-white">The premium CMS</span>
            <span class="block bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-gradient">for modern teams.</span>
        </h1>
        
        <p class="mt-6 max-w-2xl mx-auto text-lg md:text-2xl text-slate-400 font-medium leading-relaxed mb-10">
            Control your content narrative with enterprise-grade pages, unified media, granular roles, and bulletproof audit logs.
        </p>
        
        <div class="flex justify-center items-center gap-4 flex-col sm:flex-row">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-full bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-500 transition-all shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:shadow-[0_0_40px_rgba(79,70,229,0.5)] hover:-translate-y-1">
                    Enter Admin Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-full bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-500 transition-all shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:shadow-[0_0_40px_rgba(79,70,229,0.5)] hover:-translate-y-1">
                    Get Started Now
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-4 rounded-full bg-slate-800 border border-slate-700 text-white font-bold text-lg hover:bg-slate-700 hover:border-slate-600 transition-all hover:-translate-y-1 shadow-lg">
                    Explore Platform
                </a>
            @endauth
        </div>

        <!-- MOCKUP UI -->
        <div class="mt-24 relative max-w-5xl mx-auto perspective-[1000px] hidden sm:block">
            <div class="relative rounded-2xl bg-slate-900 border border-slate-800 shadow-2xl overflow-hidden transform rotate-x-[5deg] scale-100 hover:rotate-x-0 hover:scale-[1.02] transition-transform duration-700 ease-out shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                <!-- Mockup Header -->
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-800 bg-slate-900/50">
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                        <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                        <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                    </div>
                    <div class="text-xs text-slate-500 font-mono flex items-center bg-slate-800/50 px-3 py-1 rounded-md">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        nimbus-cms.app/admin/dashboard
                    </div>
                    <div class="w-4 h-4 text-slate-600"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></div>
                </div>
                <!-- Mockup Content -->
                <div class="flex h-[450px]">
                    <!-- Sidebar -->
                    <div class="w-56 bg-slate-950 border-r border-slate-800 p-5 hidden md:block relative overflow-hidden">
                        <div class="h-5 w-24 bg-slate-800 rounded mb-8"></div>
                        <div class="space-y-4">
                            <div class="h-4 w-full bg-indigo-500/20 rounded flex items-center px-2">
                                <div class="w-3 h-3 bg-indigo-500 rounded mr-2"></div>
                                <div class="h-2 w-16 bg-indigo-400/50 rounded"></div>
                            </div>
                            <div class="h-4 w-4/5 bg-slate-800/80 rounded"></div>
                            <div class="h-4 w-3/4 bg-slate-800/80 rounded"></div>
                            <div class="h-4 w-5/6 bg-slate-800/80 rounded"></div>
                            <div class="pt-6 mt-6 border-t border-slate-800 space-y-4 text-slate-800">
                                <div class="h-4 w-3/4 bg-slate-800/50 rounded"></div>
                                <div class="h-4 w-4/5 bg-slate-800/50 rounded"></div>
                            </div>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 h-10 bg-slate-800/50 rounded-lg"></div>
                    </div>
                    <!-- Main Area -->
                    <div class="flex-1 p-8 bg-slate-900 overflow-hidden relative">
                        <div class="flex gap-6 mb-8">
                            <div class="flex-1 h-28 bg-slate-800/80 rounded-2xl border border-slate-700/50 relative overflow-hidden shadow-inner flex flex-col justify-center p-4">
                                <div class="absolute left-0 top-0 h-full w-1 bg-indigo-500"></div>
                                <div class="h-3 w-12 bg-slate-700 rounded mb-2"></div>
                                <div class="h-6 w-8 bg-white/80 rounded"></div>
                            </div>
                            <div class="flex-1 h-28 bg-slate-800/80 rounded-2xl border border-slate-700/50 relative overflow-hidden shadow-inner flex flex-col justify-center p-4">
                                <div class="absolute left-0 top-0 h-full w-1 bg-purple-500"></div>
                                <div class="h-3 w-12 bg-slate-700 rounded mb-2"></div>
                                <div class="h-6 w-8 bg-white/80 rounded"></div>
                            </div>
                            <div class="flex-1 h-28 bg-slate-800/80 rounded-2xl border border-slate-700/50 relative overflow-hidden shadow-inner flex flex-col justify-center p-4">
                                <div class="absolute left-0 top-0 h-full w-1 bg-emerald-500"></div>
                                <div class="h-3 w-16 bg-slate-700 rounded mb-2"></div>
                                <div class="h-6 w-8 bg-white/80 rounded"></div>
                            </div>
                        </div>
                        <div class="h-56 w-full bg-slate-800/50 rounded-2xl border border-slate-700/50 p-5">
                            <div class="h-4 w-32 bg-slate-700 rounded mb-6"></div>
                            <div class="space-y-4">
                                <div class="flex gap-4"><div class="h-3 w-10 bg-slate-700 rounded"></div><div class="h-3 w-3/4 bg-slate-600 rounded"></div><div class="h-3 w-16 bg-indigo-500/50 rounded"></div></div>
                                <div class="flex gap-4"><div class="h-3 w-10 bg-slate-700 rounded"></div><div class="h-3 w-1/2 bg-slate-600 rounded"></div><div class="h-3 w-16 bg-emerald-500/50 rounded"></div></div>
                                <div class="flex gap-4"><div class="h-3 w-10 bg-slate-700 rounded"></div><div class="h-3 w-2/3 bg-slate-600 rounded"></div><div class="h-3 w-16 bg-indigo-500/50 rounded"></div></div>
                                <div class="flex gap-4"><div class="h-3 w-10 bg-slate-700 rounded"></div><div class="h-3 w-4/5 bg-slate-600 rounded"></div><div class="h-3 w-16 bg-purple-500/50 rounded"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Gloss effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-white/5 via-transparent to-transparent pointer-events-none"></div>
            </div>
            
            <div class="absolute -bottom-10 -z-10 left-1/2 -translate-x-1/2 w-3/4 h-20 bg-indigo-500/20 filter blur-[80px]"></div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<section class="border-y border-white/5 bg-slate-900/50 py-12 backdrop-blur-sm relative z-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-500 font-bold mb-8">Trusted by phenomenal digital teams</p>
        <div class="flex flex-wrap justify-center items-center gap-10 md:gap-20 opacity-40 grayscale hover:grayscale-0 transition-all duration-700">
            <span class="text-2xl font-black italic tracking-tighter text-white">STUDIVO.</span>
            <span class="text-2xl font-bold tracking-widest uppercase text-white">Nexus</span>
            <span class="text-2xl font-extrabold flex items-center gap-2 text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Shield</span>
            <span class="text-2xl font-serif font-bold tracking-tight text-white">Vanguard</span>
            <span class="text-2xl font-sans font-black tracking-normal lowercase text-white">omni</span>
        </div>
    </div>
</section>

<!-- FEATURES GRID -->
<section id="features" class="py-32 relative z-10 bg-slate-950">
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-purple-900/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h2 class="text-indigo-400 font-bold tracking-widest uppercase text-xs mb-3">Core Modules</h2>
            <h3 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">A complete CMS arsenal.</h3>
            <p class="text-slate-400 text-lg md:text-xl leading-relaxed">Everything you need to orchestrate content at scale, wrapped in a beautiful interface that editors actually want to use.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-marketing.feature-card 
                title="Pages & Builder Blocks" 
                desc="Construct unlimited dynamic pages with full SEO metadata, custom slug routing, and nested hierarchical architectures." 
                icon="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                color="indigo"
                badge="" />
            
            <x-marketing.feature-card 
                title="Editorial Workflow" 
                desc="Robust draft, review, and publish cycles. Never accidentally push unfinished or unapproved content live to production again." 
                icon="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                color="purple"
                badge="Pro" />

            <x-marketing.feature-card 
                title="Media Vault" 
                desc="Upload once, reuse infinitely. A centralized media library that prevents duplication and integrates globally across all content types." 
                icon="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                color="pink"
                badge="" />

            <x-marketing.feature-card 
                title="Role Based Access Control" 
                desc="Enterprise-grade Spatie permissions. Assign strict limits to Admins, Editors, Authors, mapping directly to Laravel Routes." 
                icon="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                color="emerald"
                badge="Secure" />

            <x-marketing.feature-card 
                title="Deep Audit Logs" 
                desc="Complete transparency across the workspace. Track exactly who modified what, with precise before vs. after JSON diff generation." 
                icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                color="amber"
                badge="Active" />

            <x-marketing.feature-card 
                title="Temporal Scheduling" 
                desc="Set granular dates for future delivery. Posts automatically transition to live when the exact timestamp hits, bypassing caching hurdles." 
                icon="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                color="blue"
                badge="" />
        </div>
    </div>
</section>

<!-- WORKFLOW TIMELINE -->
<section id="workflow" class="py-32 bg-slate-900 border-y border-white/5 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-5 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight mb-6 leading-tight">Publish with <span class="bg-gradient-to-r from-indigo-400 to-purple-400 text-gradient">confidence.</span></h2>
                <p class="text-slate-400 text-lg md:text-xl mb-10 leading-relaxed">A seamless workflow ensures that content is perfectly formatted, proofed, and scheduled before reaching your massive audience.</p>
                
                <div class="space-y-6">
                    <!-- Step 1 -->
                    <div class="flex gap-5 p-5 rounded-2xl border border-slate-800 bg-slate-900/50 shadow-lg relative group overflow-hidden hover:bg-slate-800 transition-colors">
                        <div class="absolute left-[38px] top-16 bottom-0 w-0.5 bg-slate-800 group-last:hidden"></div>
                        <div class="flex-shrink-0 w-14 h-14 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 z-10 font-bold text-slate-300 text-xl shadow-inner">1</div>
                        <div>
                            <h4 class="text-xl font-bold text-white mb-2">Draft & Ideate</h4>
                            <p class="text-slate-400 leading-relaxed">Authors create content, attach high-res media, and set metadata using a distraction-free, rich-text Trix editor.</p>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="flex gap-5 p-5 rounded-2xl border border-indigo-500/30 bg-indigo-500/10 shadow-[0_0_25px_rgba(99,102,241,0.15)] relative group transform scale-100 hover:scale-[1.02] transition-transform">
                        <div class="absolute left-[38px] top-16 bottom-0 w-0.5 bg-slate-800 group-last:hidden"></div>
                        <div class="flex-shrink-0 w-14 h-14 rounded-full bg-indigo-600 flex items-center justify-center border-2 border-indigo-400 z-10 font-bold text-white text-xl shadow-[0_0_15px_rgba(99,102,241,0.6)] animate-pulse-slow">2</div>
                        <div>
                            <h4 class="text-xl font-bold text-white mb-2">Review & Schedule</h4>
                            <p class="text-indigo-200/80 leading-relaxed">Editors review grammar, tweak layout blocks, and set an exact `published_at` timestamp for automated release.</p>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="flex gap-5 p-5 rounded-2xl border border-slate-800 bg-slate-900/50 shadow-lg relative group overflow-hidden hover:bg-slate-800 transition-colors">
                        <div class="flex-shrink-0 w-14 h-14 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 z-10 font-bold text-slate-300 text-xl shadow-inner">3</div>
                        <div>
                            <h4 class="text-xl font-bold text-white mb-2">Live Delivery</h4>
                            <p class="text-slate-400 leading-relaxed">The frontend router exposes the content globally when conditions are perfectly met, interacting beautifully with CDN caching.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative hidden lg:block perspective-[1000px]">
                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500/20 to-purple-500/20 rounded-3xl filter blur-[80px]"></div>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-900 p-8 shadow-2xl transform rotate-y-[-10deg] rotate-x-[5deg] hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700">
                    <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-800">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center"><svg class="w-6 h-6 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg></div>
                            <div>
                                <div class="w-32 h-4 bg-slate-700 rounded mb-2"></div>
                                <div class="w-20 h-3 bg-slate-800 rounded"></div>
                            </div>
                        </div>
                        <span class="px-4 py-1.5 text-xs font-bold tracking-wider uppercase rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30">Scheduled</span>
                    </div>
                    
                    <div class="w-4/5 h-8 bg-slate-700 rounded-lg mb-6"></div>
                    <div class="space-y-3 mb-10">
                        <div class="w-full h-3 bg-slate-800 rounded"></div>
                        <div class="w-full h-3 bg-slate-800 rounded"></div>
                        <div class="w-5/6 h-3 bg-slate-800 rounded"></div>
                        <div class="w-full h-3 bg-slate-800 rounded"></div>
                    </div>
                    
                    <div class="rounded-xl border border-slate-800 p-4 bg-slate-950 mb-6">
                        <div class="flex items-center gap-3 text-slate-400 text-sm font-mono mb-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Release Engine
                        </div>
                        <div class="w-1/2 h-3 bg-slate-800 rounded"></div>
                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
                        <div class="h-10 w-24 rounded-lg border border-slate-700 bg-slate-800"></div>
                        <div class="h-10 w-32 rounded-lg bg-indigo-600 shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECURITY & GOVERNANCE SECTION -->
<section id="security" class="py-32 relative overflow-hidden bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] p-10 md:p-16 relative overflow-hidden flex flex-col lg:flex-row items-center gap-16 shadow-2xl">
            <!-- decorative background -->
            <div class="absolute -right-32 -top-32 w-[600px] h-[600px] bg-emerald-500/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
            
            <div class="lg:w-1/2 relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-bold tracking-wider uppercase mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Enterprise Security
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-8 leading-tight">Fort Knox for <br/>your content.</h2>
                <p class="text-slate-400 text-lg md:text-xl mb-10 leading-relaxed">Protect your digital assets with battle-tested security measures out of the box. Nimbus utilizes Laravel's robust core combined with precise custom policies to mitigate all standard web vulnerabilities.</p>
                <div class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-950 border border-slate-800 text-slate-300 font-bold transition-all hover:bg-slate-800 shadow-lg">
                    Read the Security Whitepaper &rarr;
                </div>
            </div>
            
            <div class="lg:w-1/2 relative z-10 w-full">
                <div class="space-y-4">
                    <div class="flex items-start gap-5 p-5 w-full rounded-2xl bg-slate-950 border border-slate-800 shadow-md hover:border-emerald-500/40 transition-colors group">
                        <div class="bg-slate-900 border border-slate-800 rounded-lg p-2.5 group-hover:bg-emerald-500/10 transition-colors">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-1">CSRF & XSS Architecture</h4>
                            <p class="text-slate-400 leading-relaxed">Cross-site request forgery tokens enforced globally. Strict output sanitization to prevent script injection on public views.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-5 p-5 w-full rounded-2xl bg-slate-950 border border-slate-800 shadow-md hover:border-emerald-500/40 transition-colors group">
                        <div class="bg-slate-900 border border-slate-800 rounded-lg p-2.5 group-hover:bg-emerald-500/10 transition-colors">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-1">Rate-limited Endpoints</h4>
                            <p class="text-slate-400 leading-relaxed">Intelligent brute-force protection logic locking out bad actors instantly. Deeply integrated with secure Session Guarding.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-5 p-5 w-full rounded-2xl bg-slate-950 border border-slate-800 shadow-md hover:border-emerald-500/40 transition-colors group">
                        <div class="bg-slate-900 border border-slate-800 rounded-lg p-2.5 group-hover:bg-emerald-500/10 transition-colors">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-1">Immutable Master Logs</h4>
                            <p class="text-slate-400 leading-relaxed">Automatic logging of every DB mutation. Know precisely when records were shifted—acting as your internal time machine.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING DUMMY -->
<section id="pricing" class="py-32 border-y border-white/5 bg-slate-900/50 backdrop-blur-md relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h2 class="text-indigo-400 font-bold tracking-widest uppercase text-xs mb-3">Scale with us</h2>
            <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">Simple, transparent economics.</h2>
            <p class="text-slate-400 text-lg md:text-xl">Nimbus is inherently open-source. For managed zero-ops hosting, priority SLAs, and custom infrastructure—explore our cloud tiers.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center max-w-6xl mx-auto">
            <!-- Plan 1 -->
            <div class="bg-slate-950 border border-slate-800 rounded-[2rem] p-10 hover:border-slate-700 transition-colors shadow-xl">
                <h3 class="text-xl font-bold text-white mb-2">Self-Hosted</h3>
                <div class="text-5xl font-black text-white mb-4">Free</div>
                <p class="text-slate-400 text-sm mb-8 h-10">Perfect for indie developers and weekend tinkerers.</p>
                <ul class="space-y-4 mb-10 text-slate-300 font-medium">
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Full MIT Source Code</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Community Forum Support</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Unlimited Local Users</li>
                </ul>
                <a href="#" class="block w-full py-4 px-6 text-center rounded-xl border border-slate-700 hover:bg-slate-800 text-white font-bold transition-colors">Fork Repository</a>
            </div>

            <!-- Plan 2 (Highlighted) -->
            <div class="bg-slate-900 border border-indigo-500/50 rounded-[2rem] p-10 shadow-[0_0_50px_rgba(79,70,229,0.15)] relative transform md:-translate-y-6">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    <span class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-xl">Cloud Recommended</span>
                </div>
                <h3 class="text-xl font-bold text-indigo-400 mb-2">Nimbus Pro Cloud</h3>
                <div class="flex items-end gap-1 mb-4">
                    <span class="text-5xl font-black text-white">$49</span>
                    <span class="text-slate-400 mb-1 font-medium">/mo</span>
                </div>
                <p class="text-slate-400 text-sm mb-8 h-10">For serious publishers scaling their content velocity.</p>
                <ul class="space-y-4 mb-10 text-slate-200 font-medium">
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Managed Zero-ops Hosting</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Nightly Automated Backups</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Global Edge CDN Included</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Priority Email Handling</li>
                </ul>
                <a href="#register" class="block w-full py-4 px-6 text-center rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold transition-all shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_30px_rgba(79,70,229,0.5)]">Start 14-Day Free Trial</a>
            </div>

            <!-- Plan 3 -->
            <div class="bg-slate-950 border border-slate-800 rounded-[2rem] p-10 hover:border-slate-700 transition-colors shadow-xl">
                <h3 class="text-xl font-bold text-white mb-2">Enterprise Grid</h3>
                <div class="text-5xl font-black text-white mb-4">Custom</div>
                <p class="text-slate-400 text-sm mb-8 h-10">Dedicated architecture for millions of pageviews.</p>
                <ul class="space-y-4 mb-10 text-slate-300 font-medium">
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Dedicated AWS/GCP Instances</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Enterprise SSO Authentication</li>
                    <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 99.99% Guaranteed SLAs</li>
                </ul>
                <a href="#" class="block w-full py-4 px-6 text-center rounded-xl border border-slate-700 hover:bg-slate-800 text-white font-bold transition-colors">Contact Sales Board</a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-32 max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
    <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Answers & Specifications.</h2>
    </div>
    <div class="space-y-4">
        @php
            $faqs = [
                ['q' => 'Is Nimbus truly open source?', 'a' => 'Yes, the core source code is MIT licensed and completely free to self-host, modify, and distribute without encumbrances.'],
                ['q' => 'Does it support headless architecture?', 'a' => 'Absolutely. While Nimbus ships with Blade templates out of the box, you can easily bypass the front-end rendering and utilize the Eloquent models to expose custom REST API or GraphQL endpoints for headless setups.'],
                ['q' => 'What tech stack is under the hood?', 'a' => 'Nimbus runs on the latest Laravel 12 release running atop PHP 8.4+. The interface leverages a utility-first methodology via TailwindCSS mapped alongside lightweight Alpine.js reactivity.'],
                ['q' => 'How are media uploads handled?', 'a' => 'Media assets are securely pushed through a centralized Media Engine. They are saved optimally to your application storage disks and globally symlinked, fully ready to swap for AWS S3 drivers configurations.'],
                ['q' => 'Is the back-office native Dark Mode?', 'a' => 'Yes. The entire administration portal and all marketing views are meticulously crafted with first-class dark aesthetics natively embedded—easing eye strain for power-users.']
            ];
        @endphp
        
        @foreach($faqs as $faq)
        <div x-data="{ expanded: false }" class="bg-slate-900/80 backdrop-blur border border-slate-800 rounded-2xl overflow-hidden hover:border-slate-700 transition-colors shadow-lg">
            <button @click="expanded = !expanded" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:bg-slate-800/50">
                <span class="font-bold text-lg text-white pr-8">{{ $faq['q'] }}</span>
                <span class="flex-shrink-0 text-indigo-400 transform transition-transform duration-300" :class="{'rotate-180': expanded}">
                    <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </span>
            </button>
            <div x-show="expanded" x-collapse x-cloak>
                <div class="px-8 pb-8 pt-2 text-slate-400 text-lg leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- FINAL CTA -->
<section class="relative py-32 overflow-hidden border-t border-white/10">
    <div class="absolute inset-0 bg-slate-900"></div>
    <!-- Beautiful vivid glowing meshes -->
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-indigo-600/20 rounded-full mix-blend-screen filter blur-[120px] translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] -translate-x-1/3 translate-y-1/3 pointer-events-none animate-pulse-slow"></div>
    <div class="absolute inset-0 bg-grid-pattern opacity-10 pointer-events-none"></div>
    
    <div class="max-w-4xl mx-auto px-4 relative z-10 text-center text-white">
        <h2 class="text-5xl md:text-7xl font-black tracking-tight mb-8">Deploy content<br/>operations in <span class="text-indigo-400">minutes.</span></h2>
        <p class="text-xl md:text-2xl text-slate-400 font-medium mb-12 max-w-2xl mx-auto leading-relaxed">No complex YAML configurations. No fragile plugin ecosystems. Just an elegant CMS ready to power your next big web property.</p>
        
        <div class="flex justify-center items-center flex-col sm:flex-row gap-6">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto px-10 py-5 rounded-full bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-500 transition-all shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:shadow-[0_0_40px_rgba(79,70,229,0.5)] hover:-translate-y-1">
                Enter Dashboard Now
            </a>
            @else
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-5 rounded-full bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-500 transition-all shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:shadow-[0_0_40px_rgba(79,70,229,0.5)] hover:-translate-y-1">
                Create Free Account
            </a>
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-5 rounded-full border border-slate-700 bg-slate-800/80 text-white font-bold text-lg hover:bg-slate-700 hover:border-slate-600 transition-all backdrop-blur shadow-xl hover:-translate-y-1">
                Log In Existing
            </a>
            @endauth
        </div>
    </div>
</section>

@endsection
