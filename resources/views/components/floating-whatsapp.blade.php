@php
    $contactInfo = \App\Models\SiteSetting::getGroup('contact_info');
    $reservationSettings = \App\Models\SiteSetting::getGroup('contact_reservation');
    $waRaw = $reservationSettings['whatsapp_number'] ?? $contactInfo['whatsapp'] ?? $contactInfo['phone'] ?? '';
    $waNumber = preg_replace('/\D+/', '', $waRaw);

    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    } elseif (str_starts_with($waNumber, '8')) {
        $waNumber = '62' . $waNumber;
    }

    $waUrl = $waNumber !== '' ? 'https://wa.me/' . $waNumber : null;
@endphp

@if($waUrl)
    <a href="{{ $waUrl }}"
       target="_blank"
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-50 flex items-center justify-center
              w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[#25D366] text-white
              shadow-[0_4px_14px_rgba(37,211,102,0.4)]
              transition-all duration-300 ease-out
              hover:scale-110 hover:shadow-[0_6px_20px_rgba(37,211,102,0.6)]
              group floating-bounce"
       aria-label="Chat with us on WhatsApp">
        <i class="fa-brands fa-whatsapp text-[28px] sm:text-[34px] group-hover:rotate-12 transition-transform duration-300"></i>
    </a>
@endif

<style>
    @keyframes floating-bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-8px);
        }
    }
    .floating-bounce {
        animation: floating-bounce 3s ease-in-out infinite;
    }
    
    /* Ensure hover state overrides the bounce animation transform */
    .floating-bounce:hover {
        animation-play-state: paused;
    }
</style>
