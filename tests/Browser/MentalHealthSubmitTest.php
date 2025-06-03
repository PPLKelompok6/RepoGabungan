<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MentalHealthSubmitTest extends DuskTestCase
{
    /**
     * Test pengisian dan submit kuesioner burnout
     * @group test5
     */
    public function testSubmitBurnoutQuestionnaire(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'athar@gmail.com')
                ->type('password', 'Password123')
                ->press('Masuk')
                ->waitForLocation('/pasien/dashboard')
                ->pause(3000) // Tambah pause
                
                // Debug untuk halaman dashboard
                ->tap(function (Browser $browser) {
                    echo "\nChecking Dashboard Page:";
                    echo "\nCurrent URL: " . $browser->driver->getCurrentURL();
                    echo "\nPage Source Length: " . strlen($browser->driver->getPageSource());
                    echo "\nLooking for 'Mulai Tes' link...\n";
                })
                
                // Navigasi ke halaman tes dengan pengecekan lebih detail
                ->assertPresent('a:contains("Mulai Tes")')
                ->clickLink('Mulai Tes')
                ->pause(3000)
                
                // Debug untuk halaman tes
                ->tap(function (Browser $browser) {
                    echo "\nChecking Test Selection Page:";
                    echo "\nCurrent URL: " . $browser->driver->getCurrentURL();
                    echo "\nLooking for 'Mulai tes' link...\n";
                })
                
                ->assertSee('Tes Psikologi Gratis')
                ->assertPresent('a:contains("Mulai tes")')
                ->clickLink('Mulai tes')
                ->pause(3000)
                
                // Debug untuk halaman biodata
                ->tap(function (Browser $browser) {
                    echo "\nChecking Biodata Page:";
                    echo "\nCurrent URL: " . $browser->driver->getCurrentURL();
                    echo "\nChecking form elements...\n";
                })
                
                // Mengisi form biodata dengan pengecekan
                ->assertPresent('input[name="usia"]')
                ->type('usia', '22')
                ->assertPresent('select[name="gender"]')
                ->select('gender', 'Laki-laki')
                ->assertPresent('input[name="domisili"]')
                ->type('domisili', 'Bandung')
                ->assertPresent('input[name="pekerjaan"]')
                ->type('pekerjaan', 'Mahasiswa')
                ->screenshot('biodata-filled')
                
                // Submit biodata dengan pengecekan
                ->assertPresent('button[type="submit"]')
                ->press('Selanjutnya')
                ->pause(5000)
                
                // Debug untuk halaman kuesioner
                ->tap(function (Browser $browser) {
                    echo "\nChecking Questionnaire Page:";
                    echo "\nCurrent URL: " . $browser->driver->getCurrentURL();
                    echo "\nLooking for question elements...\n";
                })
                
                // Cek keberadaan pertanyaan pertama sebelum mulai loop
                ->assertPresent('input[name="q1"]')
                
                // Mengisi pertanyaan dengan pengecekan per pertanyaan
                ->tap(function (Browser $browser) {
                    for ($i = 1; $i <= 22; $i++) {
                        echo "\nProcessing question {$i}...";
                        try {
                            $value = $i % 7;
                            if (!$browser->resolver->findOrFail("input[name='q{$i}']")) {
                                echo "\nQuestion {$i} element not found!";
                                $browser->screenshot("error-q{$i}");
                                continue;
                            }
                            
                            $browser->radio("q{$i}", (string)$value)
                                   ->pause(500);
                            
                            echo " - Answered with value {$value}";
                        } catch (\Exception $e) {
                            echo "\nError on question {$i}: " . $e->getMessage();
                            $browser->screenshot("error-q{$i}");
                        }
                    }
                })
                
                // Submit kuesioner
                ->assertPresent('button[type="submit"]')
                ->press('Submit')
                ->pause(5000)
                
                // Debug untuk hasil
                ->tap(function (Browser $browser) {
                    echo "\nChecking Result Page:";
                    echo "\nCurrent URL: " . $browser->driver->getCurrentURL();
                })
                
                ->screenshot('after-submit');
        });
    }

    /**
     * Test validasi jika ada pertanyaan yang belum dijawab
     * @group test5
     */
    public function testValidationWhenSkippingQuestions(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'athar@gmail.com')
                ->type('password', 'Password123')
                ->press('Masuk')
                ->waitForLocation('/pasien/dashboard')
                ->pause(2000)
                
                // Navigasi ke halaman tes
                ->clickLink('Mulai Tes')
                ->waitForText('Tes Psikologi Gratis', 10)
                ->pause(2000)
                ->clickLink('Mulai tes')
                ->waitForText('Tes Psikologi Burnout', 10)
                ->pause(2000)
                
                // Mengisi form biodata
                ->type('usia', '22')
                ->select('gender', 'Laki-laki')
                ->type('domisili', 'Bandung')
                ->type('pekerjaan', 'Mahasiswa')
                ->screenshot('biodata-validation')
                ->press('Selanjutnya')
                ->waitFor('input[name="q1"]')
                ->pause(2000)
                
                // Hanya mengisi 3 pertanyaan
                ->waitUntilEnabled('input[name="q1"][value="0"]')
                ->click('input[name="q1"][value="0"]')
                ->pause(500)
                ->click('input[name="q2"][value="1"]')
                ->pause(500)
                ->click('input[name="q3"][value="2"]')
                ->pause(500)
                
                // Screenshot sebelum submit
                ->screenshot('partial-questions')
                ->pause(2000)
                
                // Submit dan verifikasi masih di halaman yang sama
                ->press('Submit')
                ->pause(3000)
                ->screenshot('validation-error')
                ->waitForText('Tes Psikologi Burnout');
        });
    }
} 