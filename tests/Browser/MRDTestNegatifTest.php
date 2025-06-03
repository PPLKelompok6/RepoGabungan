<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MRDTestNegatifTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group test4
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
            ->type('email', 'dokteranton@gmail.com')
            ->type('password', 'password123')
            ->press('Masuk')
            ->waitForLocation('/doctor/dashboard')
            ->assertPathIs('/doctor/dashboard')
            ->clickLink('Tambah Rekam Medis')
            ->waitForLocation('/medical-records/create')
            ->assertPathIs('/medical-records/create')
            ->pause(2000)
            ->type('record_date', date('Y-m-d'))
            ->screenshot('testdemo')
            ->type('diagnosis', 'Pasien mengalami demam dan batuk')
            ->type('recommendation', 'Istirahat yang cukup dan minum obat sesuai resep')
            ->press('Simpan Rekam Medis')
            ->waitForText('The patient id field is required.')
            ->assertSeeIn('.invalid-feedback', 'The patient id field is required.');

        });
    }
}
