<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PasienTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test6
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'hafizhrizki18@gmail.com')
                    ->type('password', 'Hafizh000')
                    ->press('Masuk')
                    ->waitForLocation('/pasien/dashboard')
                    ->press('@riwayat-digital')
                    ->waitForLocation('/e-prescriptions/history')
                    ->assertPathIs('/e-prescriptions/history');
                    
        });
    }
}
