<?php

namespace Tests\Browser\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Admin;
use App\Models\MentalHealth;

class MentalHealthResultsTest extends DuskTestCase
{
    /**
     * Test halaman daftar hasil tes mental health
     * @group test-admin
     */
    public function testMentalHealthResultsList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'Password123')
                ->press('Masuk')
                ->waitForLocation('/admin/dashboard')
                ->pause(2000)
                
                // Navigasi ke halaman hasil tes
                ->visit('/admin/mental-health/results')
                ->waitForText('Daftar Hasil Tes Mental Health Check Up')
                ->pause(2000)
                
                // Memastikan elemen filter ada
                ->assertPresent('select[name="jenis_tes"]')
                ->assertPresent('select[name="rentang_waktu"]')
                ->assertPresent('select[name="tingkat_keparahan"]')
                ->assertPresent('button[dusk="filter-button"]')
                
                // Test filter
                ->select('jenis_tes', 'Burnout')
                ->select('rentang_waktu', 'Semua Waktu')
                ->select('tingkat_keparahan', 'Semua Level')
                ->click('@filter-button')
                ->pause(2000)
                ->screenshot('after-filter')
                
                // Memastikan tabel hasil ada
                ->assertPresent('table')
                ->assertSee('No.')
                ->assertSee('Nama Pasien')
                ->assertSee('Jenis Tes')
                ->assertSee('Tanggal')
                ->assertSee('Skor')
                ->assertSee('Level')
                ->assertSee('Aksi')
                
                // Test tombol detail
                ->click('@view-result-1') // Lihat detail hasil pertama
                ->waitForText('Detail Hasil Tes')
                ->pause(2000)
                ->screenshot('view-detail')
                ->back()
                
                // Test tombol riwayat
                ->click('@history-result-1') // Lihat riwayat pasien pertama
                ->waitForText('Riwayat Tes')
                ->pause(2000)
                ->screenshot('view-history')
                ->back()
                
                // Test hapus hasil
                ->click('@delete-result-1') // Hapus hasil pertama
                ->waitForText('Apakah Anda yakin?')
                ->press('Ya')
                ->waitForText('Hasil tes berhasil dihapus')
                ->pause(2000)
                ->screenshot('after-delete');
        });
    }

    /**
     * Test filter hasil tes mental health
     * @group test-admin
     */
    public function testMentalHealthResultsFilter()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'Password123')
                ->press('Masuk')
                ->waitForLocation('/admin/dashboard')
                ->pause(2000)
                
                // Navigasi ke halaman hasil tes
                ->visit('/admin/mental-health/results')
                ->waitForText('Daftar Hasil Tes Mental Health Check Up')
                ->pause(2000)
                
                // Test filter Burnout - Level Tinggi
                ->select('jenis_tes', 'Burnout')
                ->select('tingkat_keparahan', 'Tinggi')
                ->click('@filter-button')
                ->pause(2000)
                ->screenshot('filter-burnout-high')
                
                // Test filter Depresi - Level Sedang
                ->select('jenis_tes', 'Depresi')
                ->select('tingkat_keparahan', 'Sedang')
                ->click('@filter-button')
                ->pause(2000)
                ->screenshot('filter-depression-medium')
                
                // Test filter Kecemasan - Level Rendah
                ->select('jenis_tes', 'Kecemasan')
                ->select('tingkat_keparahan', 'Rendah')
                ->click('@filter-button')
                ->pause(2000)
                ->screenshot('filter-anxiety-low')
                
                // Reset filter
                ->select('jenis_tes', 'Semua Jenis')
                ->select('rentang_waktu', 'Semua Waktu')
                ->select('tingkat_keparahan', 'Semua Level')
                ->click('@filter-button')
                ->pause(2000)
                ->screenshot('filter-reset');
        });
    }

    /**
     * Test aksi pada hasil tes mental health
     * @group test-admin
     */
    public function testMentalHealthResultsActions()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'Password123')
                ->press('Masuk')
                ->waitForLocation('/admin/dashboard')
                ->pause(2000)
                
                // Navigasi ke halaman hasil tes
                ->visit('/admin/mental-health/results')
                ->waitForText('Daftar Hasil Tes Mental Health Check Up')
                ->pause(2000)
                
                // Test tombol lihat detail
                ->click('@view-result-1')
                ->waitForText('Detail Hasil Tes')
                ->assertPresent('@patient-info')
                ->assertPresent('@test-results')
                ->screenshot('detail-view')
                ->back()
                
                // Test tombol riwayat
                ->click('@history-result-1')
                ->waitForText('Riwayat Tes')
                ->assertPresent('@history-table')
                ->screenshot('history-view')
                ->back()
                
                // Test tombol hapus - batalkan
                ->click('@delete-result-1')
                ->waitForText('Apakah Anda yakin?')
                ->press('Tidak')
                ->pause(1000)
                ->screenshot('delete-cancelled')
                
                // Test tombol hapus - konfirmasi
                ->click('@delete-result-1')
                ->waitForText('Apakah Anda yakin?')
                ->press('Ya')
                ->waitForText('Hasil tes berhasil dihapus')
                ->screenshot('delete-confirmed');
        });
    }
} 