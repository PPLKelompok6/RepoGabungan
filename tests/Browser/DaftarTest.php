<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DaftarTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test2
     */
    public function testDaftar(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Jawa')
                    ->type('email', 'Jawa@gmail.com')
                    ->select('role', 'user')
                    ->type('password', 'Password123')
                    ->type('password_confirmation', 'Password123')
                    ->press('Daftar')
                    // ->waitFor('.alert-success', 10)
                    ->waitForLocation('/pasien/dashboard')
                    ->assertPathIs('/pasien/dashboard')
                    ->waitForText('Dashboard Pasien');
        });
    }
}
