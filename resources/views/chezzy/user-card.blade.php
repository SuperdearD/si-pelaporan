@props([
    'user' => filament()->auth()->user(),
])

<div class="chezzy-user-card-wrapper flex items-center justify-center w-full px-4 py-3">
    <div class="chezzy-user-card group relative flex items-center gap-3 w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-3 transition-all duration-300">
        {{-- Avatar --}}
        <div class="chezzy-user-avatar flex-shrink-0">
            <x-filament::avatar
                :src="filament()->getUserAvatarUrl($user)"
                :alt="__('filament-panels::layout.avatar.alt', ['name' => filament()->getUserName($user)])"
                :attributes="\Filament\Support\prepare_inherited_attributes($attributes)->class([
                    'fi-user-avatar rounded-none w-8 h-8 object-cover',
                ])" />
        </div>

        {{-- User Info --}}
        <div class="chezzy-user-text flex flex-col min-w-0 transition-opacity duration-300">
            <h3 class="text-slate-900 dark:text-slate-100 font-bold text-xs tracking-wide truncate">
                {{ $user->name }}
            </h3>
            <p class="text-slate-500 dark:text-slate-400 text-[10px] uppercase font-semibold tracking-wider truncate">
                {{ $user->roles->first()->name ?? 'No Role Assigned' }}
            </p>
        </div>
    </div>
</div>
