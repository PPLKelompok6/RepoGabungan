<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class login extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
            ->assertPathIs('/login')
            ->type('e-mail Address', 'dusk@example.com')
            ->type('password', 'password123')
            ->press('Login')
            ->waitForLocation('/pasien/dashboard') // Tunggu redirect ke dashboard pasien
            ->assertPathIs('/pasien/dashboard')
            ->assertSee('Pasien Dusk'); // Pastikan nama user tampil di dashboard
        });
    }
}
