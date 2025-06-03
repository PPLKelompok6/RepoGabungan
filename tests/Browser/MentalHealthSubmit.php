<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MentalHealthSubmit extends DuskTestCase
{
    /**
     * Test untuk mengisi kuesioner burnout dengan 22 pertanyaan
     * @group test7
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'athar@gmail.com')
                ->type('password', 'Password123')
                ->press('Masuk')
                ->waitForLocation('/pasien/dashboard')
                ->assertPathIs('/pasien/dashboard')
                ->waitForText('Dashboard Pasien')
                ->screenshot('1-dashboard')
                ->clickLink('Mulai Tes')
                ->waitForText('Tes Psikologi Gratis')
                ->screenshot('2-mental-health-list')
                // Memastikan halaman daftar tes mental health tampil
                ->assertSee('Burnout')
                ->assertSee('Depresi')
                ->assertSee('Kecemasan')
                ->pause(1000)
                // Klik tombol Mulai tes untuk Burnout
                ->waitFor('.kartu-tes')
                ->screenshot('3-before-click')
                ->clickLink('Mulai tes')
                ->pause(3000)
                ->screenshot('4-after-click')
                // Mengisi form biodata
                ->waitForText('Tes Psikologi Burnout')
                ->type('usia', '22')
                ->select('gender', 'Laki-laki')
                ->type('domisili', 'Bandung')
                ->type('pekerjaan', 'Mahasiswa')
                ->screenshot('5-filled-form')
                ->press('Selanjutnya')
                ->pause(2000)
                ->screenshot('6-after-submit')
                ->waitForLocation('/mental-health/questions/burnout')
                ->pause(2000)
                ->waitForText('Tes Psikologi Burnout')
                ->assertPathIs('/mental-health/questions/burnout')
                ->screenshot('7-after-click')
                // Mengisi 22 pertanyaan kuesioner
                ->waitFor('.question-container')
                ->assertPresent('input[name="q1"]')

                // 1. Saya merasakan emosi saya terkuras karena pekerjaan
                ->click('input[name="q1"][value="0"]')
                ->pause(500)
                
                // 2. Saya merasakan kelelahan fisik yang amat sangat di akhir hari kerja
                ->click('input[name="q2"][value="1"]')
                ->pause(500)
                
                // 3. Saya merasa lesu ketika bangun pagi karena harus menjalani hari di tempat kerja
                ->click('input[name="q3"][value="2"]')
                ->pause(500)
                
                // 4. Saya sulit memahami tindakan yang dilakukan rekan-rekan kerja saya
                ->click('input[name="q4"][value="3"]')
                ->pause(500)
                
                // 5. Saya merasa bahwa saya memperlakukan beberapa rekan kerja seolah-olah mereka adalah objek
                ->click('input[name="q5"][value="4"]')
                ->pause(500)
                
                // 6. Bekerja bersama orang lain seharian penuh membuat saya stres
                ->click('input[name="q6"][value="5"]')
                ->pause(500)
                
                // 7. Saya gagal mengatasi masalah orang lain
                ->click('input[name="q7"][value="6"]')
                ->pause(500)
                
                // 8. Saya merasa lelah (burnout) karena pekerjaan saya
                ->click('input[name="q8"][value="0"]')
                ->pause(500)
                
                // 9. Saya merasa bahwa saya tidak mampu mempengaruhi orang lain secara positif
                ->click('input[name="q9"][value="1"]')
                ->pause(500)
                
                // 10. Saya menjadi lebih tidak berperasaan kepada orang-orang
                ->click('input[name="q10"][value="2"]')
                ->pause(500)
                
                // 11. Saya khawatir pekerjaan saya membuat saya lebih sulit secara emosional
                ->click('input[name="q11"][value="3"]')
                ->pause(500)
                
                // 12. Saya merasa tidak memiliki energi
                ->click('input[name="q12"][value="4"]')
                ->pause(500)
                
                // 13. Saya merasa frustrasi dengan pekerjaan saya
                ->click('input[name="q13"][value="5"]')
                ->pause(500)
                
                // 14. Saya merasa bahwa saya bekerja terlalu keras
                ->click('input[name="q14"][value="6"]')
                ->pause(500)
                
                // 15. Saya tidak terlalu tertarik dengan apa yang terjadi dengan rekan-rekan saya
                ->click('input[name="q15"][value="0"]')
                ->pause(500)
                
                // 16. Berhubungan langsung dengan orang-orang di tempat kerja terlalu membuat saya stres
                ->click('input[name="q16"][value="1"]')
                ->pause(500)
                
                // 17. Saya merasa sulit untuk membangun suasana santai di lingkungan kerja saya
                ->click('input[name="q17"][value="2"]')
                ->pause(500)
                
                // 18. Saya merasa kehilangan energi ketika saya bekerja sama dengan rekan kerja saya
                ->click('input[name="q18"][value="3"]')
                ->pause(500)
                
                // 19. Dalam pekerjaan saya, saya belum mencapai banyak keberhasilan yang bermanfaat
                ->click('input[name="q19"][value="4"]')
                ->pause(500)
                
                // 20. Saya merasa seperti kehabisan akal
                ->click('input[name="q20"][value="5"]')
                ->pause(500)
                
                // 21. Dalam pekerjaan saya, saya tidak mampu menghadapi masalah emosional dengan santai
                ->click('input[name="q21"][value="6"]')
                ->pause(500)
                
                // 22. Saya merasa rekan kerja saya menyalahkan saya atas beberapa masalah mereka
                ->click('input[name="q22"][value="0"]')
                ->pause(500)

                ->screenshot('7-filled-questionnaire')
                ->waitFor('button[type="submit"]')
                ->press('Submit')
                ->pause(2000)
                ->screenshot('8-after-submit')
                // Memastikan berhasil submit dan diarahkan ke halaman hasil
                ->assertPathIs('/mental-health/result/burnout')
                ->assertSee('Hasil Tes Burnout');
        });
    }
} 