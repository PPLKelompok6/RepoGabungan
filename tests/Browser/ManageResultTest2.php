<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ManageResultTest2 extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test13
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'atharghiffari19@gmail.com')
                    ->type('password', 'admin123')
                    ->press('Masuk')
                    ->waitForLocation('/admin/dashboard')
                    ->assertPathIs('/admin/dashboard')
                    ->waitForText('Dashboard Admin')
                    ->pause(1000)
                    ->screenshot('Dashboard Admin')
                    ->clickLink('Lihat Semua Mental')
                    ->waitForLocation('/admin/mental-health/results')
                    ->assertPathIs('/admin/mental-health/results')
                    ->pause(1000)
                    ->screenshot('Manage-Test2');
        });
    }
}
