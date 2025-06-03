<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * @group test1
     */

    public function test_register_with_valid_data()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'athar')
                    ->type('email', 'athar@gmail.com')
                    ->select('role', 'user')
                    ->type('password', 'Password123')
                    ->type('password_confirmation', 'Password123')
                    ->press('Daftar')
                    // ->waitFor('.alert-success', 10)
                    ->assertPathIs('/pasien/dashboard')
                    ->waitForText('Dashboard Pasien');
        });
    }
}