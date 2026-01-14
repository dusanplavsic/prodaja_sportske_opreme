<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kategorija;
use App\Models\Proizvodi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProizvodiController
 */
final class ProizvodiControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $proizvodis = Proizvodi::factory()->count(3)->create();

        $response = $this->get(route('proizvodis.index'));

        $response->assertOk();
        $response->assertViewIs('proizvodi.index');
        $response->assertViewHas('proizvodis', $proizvodis);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('proizvodis.create'));

        $response->assertOk();
        $response->assertViewIs('proizvodi.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProizvodiController::class,
            'store',
            \App\Http\Requests\ProizvodiStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $opis = fake()->text();
        $cena = fake()->numberBetween(-10000, 10000);
        $kolicina_na_stanju = fake()->numberBetween(-10000, 10000);
        $kategorija = Kategorija::factory()->create();

        $response = $this->post(route('proizvodis.store'), [
            'naziv' => $naziv,
            'opis' => $opis,
            'cena' => $cena,
            'kolicina_na_stanju' => $kolicina_na_stanju,
            'kategorija_id' => $kategorija->id,
        ]);

        $proizvodis = Proizvodi::query()
            ->where('naziv', $naziv)
            ->where('opis', $opis)
            ->where('cena', $cena)
            ->where('kolicina_na_stanju', $kolicina_na_stanju)
            ->where('kategorija_id', $kategorija->id)
            ->get();
        $this->assertCount(1, $proizvodis);
        $proizvodi = $proizvodis->first();

        $response->assertRedirect(route('proizvodis.index'));
        $response->assertSessionHas('proizvodi.id', $proizvodi->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $proizvodi = Proizvodi::factory()->create();

        $response = $this->get(route('proizvodis.show', $proizvodi));

        $response->assertOk();
        $response->assertViewIs('proizvodi.show');
        $response->assertViewHas('proizvodi', $proizvodi);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $proizvodi = Proizvodi::factory()->create();

        $response = $this->get(route('proizvodis.edit', $proizvodi));

        $response->assertOk();
        $response->assertViewIs('proizvodi.edit');
        $response->assertViewHas('proizvodi', $proizvodi);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProizvodiController::class,
            'update',
            \App\Http\Requests\ProizvodiUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $proizvodi = Proizvodi::factory()->create();
        $naziv = fake()->word();
        $opis = fake()->text();
        $cena = fake()->numberBetween(-10000, 10000);
        $kolicina_na_stanju = fake()->numberBetween(-10000, 10000);
        $kategorija = Kategorija::factory()->create();

        $response = $this->put(route('proizvodis.update', $proizvodi), [
            'naziv' => $naziv,
            'opis' => $opis,
            'cena' => $cena,
            'kolicina_na_stanju' => $kolicina_na_stanju,
            'kategorija_id' => $kategorija->id,
        ]);

        $proizvodi->refresh();

        $response->assertRedirect(route('proizvodis.index'));
        $response->assertSessionHas('proizvodi.id', $proizvodi->id);

        $this->assertEquals($naziv, $proizvodi->naziv);
        $this->assertEquals($opis, $proizvodi->opis);
        $this->assertEquals($cena, $proizvodi->cena);
        $this->assertEquals($kolicina_na_stanju, $proizvodi->kolicina_na_stanju);
        $this->assertEquals($kategorija->id, $proizvodi->kategorija_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $proizvodi = Proizvodi::factory()->create();

        $response = $this->delete(route('proizvodis.destroy', $proizvodi));

        $response->assertRedirect(route('proizvodis.index'));

        $this->assertModelMissing($proizvodi);
    }
}
