@props(['title', 'desc', 'icon', 'color' => 'indigo', 'badge' => ''])

@php
    $colorMap = [
        'indigo' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
        'purple' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
        'emerald' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        'blue' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
        'amber' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
        'pink' => 'bg-pink-500/10 text-pink-400 border-pink-500/20',
    ];
    $iconClasses = $colorMap[$color] ?? $colorMap['indigo'];
@endphp

<div class="relative p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:bg-slate-800 hover:border-slate-700 transition-all duration-300 group overflow-hidden shadow-lg hover:shadow-2xl">
    <!-- Glow effect on hover -->
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
        <div class="absolute -inset-1 bg-gradient-to-r from-{{ $color }}-500/10 to-transparent blur-2xl z-0"></div>
    </div>
    
    <div class="relative z-10 flex justify-between items-start mb-6">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center border {{ $iconClasses }} group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
        </div>
        
        @if($badge)
            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase bg-{{ $color }}-500/10 text-{{ $color }}-400 border border-{{ $color }}-500/20">
                {{ $badge }}
            </span>
        @endif
    </div>
    
    <div class="relative z-10">
        <h4 class="text-xl font-bold text-white mb-2 group-hover:text-{{ $color }}-300 transition-colors">{{ $title }}</h4>
        <p class="text-slate-400 leading-relaxed text-sm">{{ $desc }}</p>
    </div>
</div>
