<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MomentController;
use App\Http\Controllers\MenuController;
use App\Models\SiteSetting;

Route::view('/', 'pages.home')->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{product}', [MenuController::class, 'show'])->name('menu.show');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'first_name' => 'nullable|string|max:100',
        'last_name' => 'nullable|string|max:100',
        'email' => 'nullable|email|max:255',
        'reservation_date' => 'nullable|date|after_or_equal:today',
        'reservation_time' => 'nullable|date_format:H:i',
        'subject' => 'nullable|string|max:150',
        'message' => 'nullable|string|max:2000',
    ]);

    $contactInfo = SiteSetting::getGroup('contact_info');
    $reservationSettings = SiteSetting::getGroup('contact_reservation');
    $reservationEnabled = ($reservationSettings['enabled'] ?? '1') === '1';

    if (! $reservationEnabled) {
        return redirect()->route('contact')->with('error', 'Form reservasi sedang dinonaktifkan oleh admin.');
    }

    $waAdminRaw = $reservationSettings['whatsapp_number'] ?? $contactInfo['whatsapp'] ?? $contactInfo['phone'] ?? '';
    $waAdminNumber = preg_replace('/\D+/', '', $waAdminRaw);

    if (str_starts_with($waAdminNumber, '0')) {
        $waAdminNumber = '62' . substr($waAdminNumber, 1);
    } elseif (str_starts_with($waAdminNumber, '8')) {
        $waAdminNumber = '62' . $waAdminNumber;
    }

    if ($waAdminNumber === '') {
        return redirect()->route('contact')->with('error', 'Nomor WhatsApp admin belum diatur.');
    }

    $templateOpening = trim((string) ($reservationSettings['template_opening'] ?? ''));
    if ($templateOpening === '') {
        $templateOpening = 'Halo Admin, saya ingin reservasi dengan detail berikut:';
    }

    $templateClosing = trim((string) ($reservationSettings['template_closing'] ?? ''));
    if ($templateClosing === '') {
        $templateClosing = 'Mohon info ketersediaannya. Terima kasih.';
    }

    $subjectOptions = json_decode($reservationSettings['subject_options_json'] ?? '[]', true);
    if (!is_array($subjectOptions)) {
        $subjectOptions = [];
    }
    $subjectOptions = array_values(array_filter(array_map('trim', $subjectOptions)));

    $fullName = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
    $subject = trim((string) ($data['subject'] ?? ''));
    if (!empty($subjectOptions) && !in_array($subject, $subjectOptions, true)) {
        $subject = '-';
    }
    $reservationDate = $data['reservation_date'] ?? '';
    $reservationTime = $data['reservation_time'] ?? '';

    if ($reservationDate !== '') {
        $dateParts = explode('-', $reservationDate);
        if (count($dateParts) === 3) {
            $reservationDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
        }
    }

    if ($reservationTime !== '') {
        $reservationTime .= ' WIB';
    }

    $waTemplate = implode("\n", [
        $templateOpening,
        '',
        '- Nama: ' . ($fullName !== '' ? $fullName : '-'),
        '- Email: ' . ($data['email'] ?? '-'),
        '- Tanggal Reservasi: ' . ($reservationDate !== '' ? $reservationDate : '-'),
        '- Waktu Reservasi: ' . ($reservationTime !== '' ? $reservationTime : '-'),
        '- Subjek: ' . ($subject !== '' ? $subject : '-'),
        '- Pesan: ' . ($data['message'] ?? '-'),
        '',
        $templateClosing,
    ]);

    $waUrl = 'https://wa.me/' . $waAdminNumber . '?text=' . urlencode($waTemplate);

    return redirect()->away($waUrl);
})->name('contact.reserve');

// Admin Routes (protected)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    
    // Products CRUD
    Route::resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Moments Gallery CRUD
    Route::resource('moments', MomentController::class);

    // Site Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('home-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'homeHero'])->name('home.hero');
        Route::put('home-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateHomeHero']);
        Route::get('home-gallery', [\App\Http\Controllers\Admin\SiteSettingController::class, 'homeGallery'])->name('home.gallery');
        Route::put('home-gallery', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateHomeGallery']);
        Route::get('home-location', [\App\Http\Controllers\Admin\SiteSettingController::class, 'homeLocation'])->name('home.location');
        Route::put('home-location', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateHomeLocation']);
        
        Route::get('about-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'aboutHero'])->name('about.hero');
        Route::put('about-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateAboutHero']);
        
        Route::get('menu-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'menuHero'])->name('menu.hero');
        Route::put('menu-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateMenuHero']);
        
        Route::get('contact-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'contactHero'])->name('contact.hero');
        Route::put('contact-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateContactHero']);
        Route::get('contact-info', [\App\Http\Controllers\Admin\SiteSettingController::class, 'contactInfo'])->name('contact.info');
        Route::put('contact-info', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateContactInfo']);

        Route::get('best-seller', [\App\Http\Controllers\Admin\SiteSettingController::class, 'bestSeller'])->name('best-seller');
        Route::put('best-seller', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateBestSeller']);

        Route::get('team', [\App\Http\Controllers\Admin\TeamMemberController::class, 'index'])->name('about.team');
        Route::post('team', [\App\Http\Controllers\Admin\TeamMemberController::class, 'store'])->name('team.store');
        Route::put('team/{teamMember}', [\App\Http\Controllers\Admin\TeamMemberController::class, 'update'])->name('team.update');
        Route::delete('team/{teamMember}', [\App\Http\Controllers\Admin\TeamMemberController::class, 'destroy'])->name('team.destroy');

        Route::get('footer', [\App\Http\Controllers\Admin\SiteSettingController::class, 'footer'])->name('footer');
        Route::put('footer', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateFooter']);
    });
});





Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
