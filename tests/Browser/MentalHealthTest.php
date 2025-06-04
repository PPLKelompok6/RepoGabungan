<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MentalHealthTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test3
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'athar@gmail.com')
                    ->type('password', 'Password123')
                    ->press('Masuk')
                    ->waitForLocation('/pasien/dashboard')
                    ->assertPathIs('/pasien/dashboard')
                    ->waitForText('Dashboard Pasien')
                    ->screenshot('1-dashboard')
                    ->clickLink('Mulai Tes')
                    ->waitForText('Tes Psikologi Gratis')
                    ->screenshot('2-mental-health-list')
                    // Memastikan halaman daftar tes mental health tampil
                    ->assertSee('Burnout')
                    ->assertSee('Depresi')
                    ->assertSee('Kecemasan')
                    ->pause(1000)
                    // Klik tombol Mulai tes untuk Burnout
                    ->waitFor('.kartu-tes')
                    ->screenshot('3-before-click')
                    ->clickLink('Mulai tes')
                    ->pause(3000)
                    ->screenshot('4-after-click')
                    // Mengisi form biodata
                    ->waitForText('Tes Psikologi Burnout')
                    ->type('usia', '22')
                    ->select('gender', 'Laki-laki')
                    ->type('domisili', 'Bandung')
                    ->type('pekerjaan', 'Mahasiswa')
                    ->screenshot('5-filled-form')
                    ->press('Selanjutnya')
                    ->pause(2000)
                    // Memastikan masih berada di halaman yang sama
                    ->assertPathIs('/mental-health/test/burnout')
                    ->assertSee('Tes Psikologi Burnout')
                    ->screenshot('6-after-submit');
        });
    }
}
