<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DoctorPrescriptionTest extends DuskTestCase
{
    // use DatabaseMigrations;

    public function testFullPrescriptionFlow()
    {
        $this->browse(function (Browser $browser) {
            // Registrasi akun dokter baru
            $browser->visit('/register')
                    ->type('name', 'Athar Ghiffari')
                    ->type('email', 'atharghiffari19@gmail.com')
                    ->select('role', 'doctor') // Pastikan nilai option 'doctor' ada di select `role`
                    ->type('password', 'Athar000')
                    ->type('password_confirmation', 'Athar000')
                    ->press('Daftar')
                    ->assertPathIs('/doctor/dashboard')
                    ->waitForText('Dashboard Dokter');

            // Ambil user yang baru dibuat
            $dokter = User::where('email', 'atharghiffari19@gmail.com')->first();

            // Buat resep untuk appointment ke-3
            $browser->loginAs($dokter)
                    ->visit('/doctor/appointments/history')
                    ->assertSee('Buat Resep')
                    ->click('@buat-resep-3') // pastikan tombol memiliki dusk="buat-resep-3"
                    ->waitForLocation('/e-prescriptions/3')
                    ->waitFor('@medication_details', 3)
                    ->type('@medication_details', 'Panadol 500mg 3x1')
                    ->type('@instructions', '2x1 setelah makan')
                    ->type('@notes', 'Rutin diminum sampai habis')
                    ->type('@valid_until', '2025-06-10')
                    ->press('@submit-resep')
                    ->waitForText('Resep berhasil dibuat', 5)
                    ->assertSee('Resep berhasil dibuat');
        });
    }
}
