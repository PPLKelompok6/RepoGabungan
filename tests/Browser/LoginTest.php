<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * @group test1
     */
    

    public function testRegisterValid()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'gilang@gmail.com')
                    ->type('password', 'Password123')
                    ->press('Masuk')
                    // ->waitFor('.alert-success', 10)
                    ->waitForLocation('/pasien/dashboard')
                    ->assertPathIs('/pasien/dashboard')
                    ->waitForText('Dashboard Pasien')
                    ->pause(1000)
                    ->screenshot('test');
        });
    }
}
