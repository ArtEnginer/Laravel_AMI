<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('pages.auth.login');
})->middleware(['guest']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/change-profile-avatar', [DashboardController::class, 'changeAvatar'])->name('change-profile-avatar');
    Route::delete('/remove-profile-avatar', [DashboardController::class, 'removeAvatar'])->name('remove-profile-avatar');

    Route::middleware(['can:admin'])->group(function () {
        Route::resource('admin', AdminController::class);
        Route::resource('auditor', AuditorController::class);
        Route::resource('prodi', StudyProgramController::class);
        Route::resource('fakultas', FacultyController::class);
        Route::resource('ami', AuditPlanController::class);
        Route::resource('standar', StandardController::class);
        Route::resource('pertanyaan', QuestionController::class);
        Route::resource('nilai', ValueController::class);
        Route::resource('tahun', TahunController::class);

        // Laporan
        Route::get('laporan/hasil_ami', [ReportController::class, 'index'])->name('laporan.hasil_ami');
        Route::get('laporan/temuan_ringan', [ReportController::class, 'temuan_ringan'])->name('laporan.temuan_ringan');
        Route::get('laporan/temuan_berat', [ReportController::class, 'temuan_berat'])->name('laporan.temuan_berat');
    });

    Route::middleware(['can:auditor'])->group(function () {
        // Audit
        Route::get('dashboard/audit/{id}', [DashboardController::class, 'audit'])->name('dashboard.audit');
        Route::post('dashboard/input_audit', [DashboardController::class, 'input_audit'])->name('dashboard.input_audit');
        Route::delete('dashboard/delete_audit/{id}', [DashboardController::class, 'delete_audit'])->name('dashboard.delete_audit');
        // Tanggal RTM
        Route::get('dashboard/tanggal_rtm/{id}', [DashboardController::class, 'tanggal_rtm'])->name('dashboard.tanggal_rtm');
        Route::put('dashboard/update_tanggal_rtm/{id}', [DashboardController::class, 'update_tanggal_rtm'])->name('dashboard.update_tanggal_rtm');
        // Kesimpulan
        Route::get('dashboard/kesimpulan/{id}', [DashboardController::class, 'kesimpulan'])->name('dashboard.kesimpulan');
        Route::put('dashboard/update_kesimpulan/{id}', [DashboardController::class, 'update_kesimpulan'])->name('dashboard.update_kesimpulan');
        // Foto Kegiatan
        Route::get('dashboard/foto_kegiatan/{id}', [DashboardController::class, 'foto_kegiatan'])->name('dashboard.foto_kegiatan');
        Route::put('dashboard/upload_foto_kegiatan/{id}', [DashboardController::class, 'upload_foto_kegiatan'])->name('dashboard.upload_foto_kegiatan');

        // Standar Pertanyaan
        Route::get('standarpertanyaanaudit', [AuditController::class, 'index'])->name('standarpertanyaan.audit');
        Route::get('standarpertanyaanaudit/add/nilai/{id}/{sid}', [AuditController::class, 'create_nilai'])->name('standarpertanyaan.nilai');
        Route::post('standarpertanyaanaudit/add/nilai/{id}/{sid}', [AuditController::class, 'store_nilai'])->name('standarpertanyaan.nilai.store');
        Route::get('standarpertanyaanaudit/add/rekomendasi/{id}/{sid}', [AuditController::class, 'create_rekomendasi'])->name('standarpertanyaan.rekomendasi');
        Route::post('standarpertanyaanaudit/add/rekomendasi/{id}/{sid}', [AuditController::class, 'store_rekomendasi'])->name('standarpertanyaan.rekomendasi.store');
        // Laporan
        Route::get('laporan-audit/ami', [AuditController::class, 'laporan_ami'])->name('laporan.audit.ami');
        Route::get('laporan-audit/ketercapaian', [AuditController::class, 'laporan_ketercapaian'])->name('laporan.audit.ketercapaian');
        Route::get('laporan-audit/temuan-ringan', [AuditController::class, 'laporan_temuan_ringan'])->name('laporan.audit.ringan');
        Route::get('laporan-audit/temuan-berat', [AuditController::class, 'laporan_temuan_berat'])->name('laporan.audit.berat');
        Route::get('laporan-audit/print/{type}', [AuditController::class, 'print'])->name('laporan.audit.print');
    });

    Route::middleware(['can:prodi'])->group(function () {
        Route::get('dashboard/ubah_status_audit/{id}', [DashboardController::class, 'ubah_status_audit'])->name('dashboard.ubah_status_audit');
        Route::get('standarpertanyaan', [ProdiController::class, 'index'])->name('standarpertanyaan.index');
        Route::get('standarpertanyaan/add/bukti/{id}/{sid}', [ProdiController::class, 'create_bukti'])->name('standarpertanyaan.bukti');
        Route::post('standarpertanyaan/add/bukti/{id}/{sid}', [ProdiController::class, 'store_bukti'])->name('standarpertanyaan.bukti.store');
        // Laporan
        Route::get('laporan-prodi/ami', [ProdiController::class, 'laporan_ami'])->name('laporan.prodi.ami');
        Route::get('laporan-prodi/ketercapaian', [ProdiController::class, 'laporan_ketercapaian'])->name('laporan.prodi.ketercapaian');
        Route::get('laporan-prodi/temuan-ringan', [ProdiController::class, 'laporan_temuan_ringan'])->name('laporan.prodi.ringan');
        Route::get('laporan-prodi/temuan-berat', [ProdiController::class, 'laporan_temuan_berat'])->name('laporan.prodi.berat');
        Route::get('laporan-prodi/print/{type}', [ProdiController::class, 'print'])->name('laporan.prodi.print');

    });

    Route::get('laporan/print/{id}', [ReportController::class, 'print'])->name('laporan.print');
});