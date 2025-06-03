<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class DoctorPrescriptionTest extends DuskTestCase
{
    /** 
     * Test dokter bisa membuat resep melalui form e-prescription.
     */
    public function test_dokter_bisa_membuat_resep()
    {
        $dokter = User::where('email', 'atharghiffari19@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($dokter) {
            $browser->loginAs($dokter)
                    ->visit('/doctor/appointments/history')
                    ->assertSee('Buat Resep')
                    ->click('@buat-resep-3')
                    ->waitForLocation('/e-prescriptions/3')  // tunggu sampai url benar
                    ->type('medication_details', 'Panadol')
                    ->type('instructions', '2x1')
                    ->type('notes', 'Rutin')
                    ->type('valid_until', '2025-06-10')
                    ->press('Buat Resep')
                    ->waitForText('Resep berhasil dibuat', 5)
                    ->assertSee('Resep berhasil dibuat');
        });
    }
}
