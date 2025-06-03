<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test2
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
                    ->pause(1000)
                    ->screenshot('testss');
        });
    }
}
