<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ResepTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test7
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'hafizhrizki18@gmail.com')
                    ->type('password', 'Hafizh000')
                    ->press('Masuk')
                    ->waitForLocation('/pasien/dashboard')
                    ->clickLink('Lihat Riwayat')
                    ->waitForLocation('/appointments/history')
                    ->assertPathIs('/appointments/history')
                    ->click('.table tbody tr:first-child a.btn-info')
                    ->waitForLocation('/e-prescriptions/4')
                    ->assertPathIs('/e-prescriptions/4');
                    
        });
    }
}
