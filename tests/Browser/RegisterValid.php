<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterValid extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_register_with_valid_data()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertPathIs('/register')
                    ->type('name', 'Pasien Dusk')
                    ->type('email', 'dusk@example.com')
                    ->select('role', 'user')
                    ->type('password', 'password123')
                    ->type('password_confirmation', 'password123')
                    ->press('Register')
                    ->waitForLocation('/pasien/dashboard') // Tunggu redirect ke dashboard pasien
                    ->assertPathIs('/pasien/dashboard')
                    ->assertSee('Pasien Dusk'); // Pastikan nama user tampil di dashboard
        });
    }
}