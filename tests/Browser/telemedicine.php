<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class telemedicine extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/pasien/dashboard')
                    ->assertSee('Dashboard Pasien')
                    ->clickLink('Mulai Chat') // Menggunakan clickLink untuk tautan
                    ->assertPathIs('/chat') // Memastikan redirect ke halaman chat
                    ->select('user_id', '2') // Menggunakan name="user_id" dan value dokter (misalnya 2)
                    ->type('message', 'Hai dokter') // Menggunakan name="message" untuk input teks
                    ->press('Kirim')
                    ->waitForText('Hai dokter', 5) // Menunggu teks muncul
                    ->assertSee('Hai dokter');
        });
    }
}
