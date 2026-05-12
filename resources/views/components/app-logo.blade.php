@props([
    'sidebar' => false,
])

@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
    $brandName = trim((string) ($footerSettings['brand_name'] ?? 'Ara'));
    $brandAccent = trim((string) ($footerSettings['brand_accent'] ?? 'Cafe'));
    $brandDisplayName = trim($brandName . ' ' . $brandAccent);
    if ($brandDisplayName === '') {
        $brandDisplayName = config('app.name', 'Brand');
    }

    $resolveAssetUrl = static function (?string $path): string {
        $path = trim((string) $path);

        if ($path === '') {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return asset($path);
    };

    $brandLogoLight = $resolveAssetUrl($footerSettings['brand_logo_light'] ?? ($footerSettings['brand_logo'] ?? ''));
    $brandLogoDark = $resolveAssetUrl($footerSettings['brand_logo_dark'] ?? '');

    if ($brandLogoLight === '') {
        foreach ([
            'assets/brand-logo-brown.png',
            'assets/ebc83c00-5985-47cb-86ae-16af1fe48e4b-removebg-preview.png',
            'assets/logo-ara.jpg',
            'assets/Logo_Ara-removebg-preview.png',
        ] as $candidate) {
            if (file_exists(public_path($candidate))) {
                $brandLogoLight = asset($candidate);
                break;
            }
        }
    }

    if ($brandLogoDark === '') {
        foreach ([
            'assets/brand-logo-white.png',
            'assets/Logo_Ara-removebg-preview.png',
        ] as $candidate) {
            if (file_exists(public_path($candidate))) {
                $brandLogoDark = asset($candidate);
                break;
            }
        }
    }
@endphp

@if($sidebar)
    <flux:sidebar.brand name="{{ $brandDisplayName }}" {{ $attributes }}>
        <x-slot name="logo" class="flex h-8 items-center justify-center rounded-md overflow-hidden">
            @if($brandLogoLight !== '' || $brandLogoDark !== '')
                @if($brandLogoLight !== '')
                    <img src="{{ $brandLogoLight }}" alt="{{ $brandDisplayName }}" class="h-6 w-auto object-contain dark:hidden">
                @endif
                @if($brandLogoDark !== '')
                    <img src="{{ $brandLogoDark }}" alt="{{ $brandDisplayName }}" class="{{ $brandLogoLight !== '' ? 'hidden dark:block' : '' }} h-6 w-auto object-contain">
                @endif
            @else
                <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
            @endif
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="{{ $brandDisplayName }}" {{ $attributes }}>
        <x-slot name="logo" class="flex h-8 items-center justify-center rounded-md overflow-hidden">
            @if($brandLogoLight !== '' || $brandLogoDark !== '')
                @if($brandLogoLight !== '')
                    <img src="{{ $brandLogoLight }}" alt="{{ $brandDisplayName }}" class="h-6 w-auto object-contain dark:hidden">
                @endif
                @if($brandLogoDark !== '')
                    <img src="{{ $brandLogoDark }}" alt="{{ $brandDisplayName }}" class="{{ $brandLogoLight !== '' ? 'hidden dark:block' : '' }} h-6 w-auto object-contain">
                @endif
            @else
                <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
            @endif
        </x-slot>
    </flux:brand>
@endif
