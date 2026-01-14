<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kupci;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KupciController
 */
final class KupciControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $kupcis = Kupci::factory()->count(3)->create();

        $response = $this->get(route('kupcis.index'));

        $response->assertOk();
        $response->assertViewIs('kupci.index');
        $response->assertViewHas('kupcis', $kupcis);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('kupcis.create'));

        $response->assertOk();
        $response->assertViewIs('kupci.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KupciController::class,
            'store',
            \App\Http\Requests\KupciStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $ime = fake()->word();
        $prezime = fake()->word();
        $email = fake()->safeEmail();
        $telefon = fake()->word();

        $response = $this->post(route('kupcis.store'), [
            'ime' => $ime,
            'prezime' => $prezime,
            'email' => $email,
            'telefon' => $telefon,
        ]);

        $kupcis = Kupci::query()
            ->where('ime', $ime)
            ->where('prezime', $prezime)
            ->where('email', $email)
            ->where('telefon', $telefon)
            ->get();
        $this->assertCount(1, $kupcis);
        $kupci = $kupcis->first();

        $response->assertRedirect(route('kupcis.index'));
        $response->assertSessionHas('kupci.id', $kupci->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $kupci = Kupci::factory()->create();

        $response = $this->get(route('kupcis.show', $kupci));

        $response->assertOk();
        $response->assertViewIs('kupci.show');
        $response->assertViewHas('kupci', $kupci);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $kupci = Kupci::factory()->create();

        $response = $this->get(route('kupcis.edit', $kupci));

        $response->assertOk();
        $response->assertViewIs('kupci.edit');
        $response->assertViewHas('kupci', $kupci);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KupciController::class,
            'update',
            \App\Http\Requests\KupciUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $kupci = Kupci::factory()->create();
        $ime = fake()->word();
        $prezime = fake()->word();
        $email = fake()->safeEmail();
        $telefon = fake()->word();

        $response = $this->put(route('kupcis.update', $kupci), [
            'ime' => $ime,
            'prezime' => $prezime,
            'email' => $email,
            'telefon' => $telefon,
        ]);

        $kupci->refresh();

        $response->assertRedirect(route('kupcis.index'));
        $response->assertSessionHas('kupci.id', $kupci->id);

        $this->assertEquals($ime, $kupci->ime);
        $this->assertEquals($prezime, $kupci->prezime);
        $this->assertEquals($email, $kupci->email);
        $this->assertEquals($telefon, $kupci->telefon);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $kupci = Kupci::factory()->create();

        $response = $this->delete(route('kupcis.destroy', $kupci));

        $response->assertRedirect(route('kupcis.index'));

        $this->assertModelMissing($kupci);
    }
}
