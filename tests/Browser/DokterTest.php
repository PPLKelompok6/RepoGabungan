<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DokterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test5
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'alliciagonza16@gmail.com')
                    ->type('password', 'Allicia000')
                    ->press('Masuk')
                    ->waitForLocation('/doctor/dashboard')
                    ->assertPathIs('/doctor/dashboard')
                    ->clickLink('Lihat Riwayat')
                    ->waitForLocation('/doctor/appointments/history')
                    ->assertPathIs('/doctor/appointments/history')
                    ->press('@buat-resep-5')
                    ->assertPathIs('/e-prescriptions/create/5')
                    ->type('#medication_details', 'Tes')
                    ->type('#instructions', 'Tes')
                    ->type('#notes', 'Tes')
                    ->press('Buat Resep')
                    ->pause(1000)
                    ->screenshot('tes');
        });
    }
}
