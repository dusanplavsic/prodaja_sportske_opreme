<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kategorije;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KategorijeController
 */
final class KategorijeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $kategorijes = Kategorije::factory()->count(3)->create();

        $response = $this->get(route('kategorijes.index'));

        $response->assertOk();
        $response->assertViewIs('kategorije.index');
        $response->assertViewHas('kategorijes', $kategorijes);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('kategorijes.create'));

        $response->assertOk();
        $response->assertViewIs('kategorije.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KategorijeController::class,
            'store',
            \App\Http\Requests\KategorijeStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $opis = fake()->text();

        $response = $this->post(route('kategorijes.store'), [
            'naziv' => $naziv,
            'opis' => $opis,
        ]);

        $kategorijes = Kategorije::query()
            ->where('naziv', $naziv)
            ->where('opis', $opis)
            ->get();
        $this->assertCount(1, $kategorijes);
        $kategorije = $kategorijes->first();

        $response->assertRedirect(route('kategorijes.index'));
        $response->assertSessionHas('kategorije.id', $kategorije->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $kategorije = Kategorije::factory()->create();

        $response = $this->get(route('kategorijes.show', $kategorije));

        $response->assertOk();
        $response->assertViewIs('kategorije.show');
        $response->assertViewHas('kategorije', $kategorije);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $kategorije = Kategorije::factory()->create();

        $response = $this->get(route('kategorijes.edit', $kategorije));

        $response->assertOk();
        $response->assertViewIs('kategorije.edit');
        $response->assertViewHas('kategorije', $kategorije);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KategorijeController::class,
            'update',
            \App\Http\Requests\KategorijeUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $kategorije = Kategorije::factory()->create();
        $naziv = fake()->word();
        $opis = fake()->text();

        $response = $this->put(route('kategorijes.update', $kategorije), [
            'naziv' => $naziv,
            'opis' => $opis,
        ]);

        $kategorije->refresh();

        $response->assertRedirect(route('kategorijes.index'));
        $response->assertSessionHas('kategorije.id', $kategorije->id);

        $this->assertEquals($naziv, $kategorije->naziv);
        $this->assertEquals($opis, $kategorije->opis);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $kategorije = Kategorije::factory()->create();

        $response = $this->delete(route('kategorijes.destroy', $kategorije));

        $response->assertRedirect(route('kategorijes.index'));

        $this->assertModelMissing($kategorije);
    }
}
