@props([
    'href' => null,
    'heightClass' => 'h-10',
    'textClass' => 'text-xl sm:text-2xl font-serif font-bold tracking-tighter text-[#2D1B10]',
    'accentClass' => 'text-[#D4A373]',
    'background' => 'light',
    'settingGroup' => 'footer',
    'logoLightKey' => 'brand_logo_light',
    'logoDarkKey' => 'brand_logo_dark',
    'legacyLogoKey' => 'brand_logo',
])

@php
    $footerSettings = \App\Models\SiteSetting::getGroup('footer');
    $sourceSettings = $settingGroup === 'footer'
        ? $footerSettings
        : \App\Models\SiteSetting::getGroup($settingGroup);

    $brandName = trim((string) ($footerSettings['brand_name'] ?? 'ARA'));
    $brandAccent = trim((string) ($footerSettings['brand_accent'] ?? 'CAFE'));
    $brandLogoLight = trim((string) ($sourceSettings[$logoLightKey] ?? ($sourceSettings[$legacyLogoKey] ?? '')));
    $brandLogoDark = trim((string) ($sourceSettings[$logoDarkKey] ?? ''));

    if ($brandLogoLight === '') {
        $brandLogoLight = trim((string) ($footerSettings['brand_logo_light'] ?? ($footerSettings['brand_logo'] ?? '')));
    }

    if ($brandLogoDark === '') {
        $brandLogoDark = trim((string) ($footerSettings['brand_logo_dark'] ?? ''));
    }

    $brandText = trim($brandName . ' ' . $brandAccent);
    if ($brandText === '') {
        $brandText = config('app.name', 'Brand');
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

    $brandLogoLight = $resolveAssetUrl($brandLogoLight);
    $brandLogoDark = $resolveAssetUrl($brandLogoDark);

    if ($brandLogoLight === '') {
        $lightCandidates = [
            'assets/brand-logo-brown.png',
            'assets/ebc83c00-5985-47cb-86ae-16af1fe48e4b-removebg-preview.png',
            'assets/logo-ara.jpg',
            'assets/Logo_Ara-removebg-preview.png',
        ];

        foreach ($lightCandidates as $candidate) {
            if (file_exists(public_path($candidate))) {
                $brandLogoLight = asset($candidate);
                break;
            }
        }
    }

    if ($brandLogoDark === '') {
        $darkCandidates = [
            'assets/brand-logo-white.png',
            'assets/Logo_Ara-removebg-preview.png',
        ];

        foreach ($darkCandidates as $candidate) {
            if (file_exists(public_path($candidate))) {
                $brandLogoDark = asset($candidate);
                break;
            }
        }
    }

    $logoToRender = strtolower((string) $background) === 'dark'
        ? ($brandLogoDark !== '' ? $brandLogoDark : $brandLogoLight)
        : ($brandLogoLight !== '' ? $brandLogoLight : $brandLogoDark);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class(['inline-flex items-center']) }}>
        @if ($logoToRender !== '')
            <img src="{{ $logoToRender }}" alt="{{ $brandText }}" class="{{ $heightClass }} w-auto object-contain">
        @else
            <span class="{{ $textClass }}">
                {{ strtoupper($brandName) }}
                @if ($brandAccent !== '')
                    <span class="{{ $accentClass }}">{{ strtoupper($brandAccent) }}</span>
                @endif
            </span>
        @endif
    </a>
@else
    <span {{ $attributes->class(['inline-flex items-center']) }}>
        @if ($logoToRender !== '')
            <img src="{{ $logoToRender }}" alt="{{ $brandText }}" class="{{ $heightClass }} w-auto object-contain">
        @else
            <span class="{{ $textClass }}">
                {{ strtoupper($brandName) }}
                @if ($brandAccent !== '')
                    <span class="{{ $accentClass }}">{{ strtoupper($brandAccent) }}</span>
                @endif
            </span>
        @endif
    </span>
@endif
