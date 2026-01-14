<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kupac;
use App\Models\Porudzbine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PorudzbineController
 */
final class PorudzbineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $porudzbines = Porudzbine::factory()->count(3)->create();

        $response = $this->get(route('porudzbines.index'));

        $response->assertOk();
        $response->assertViewIs('porudzbine.index');
        $response->assertViewHas('porudzbines', $porudzbines);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('porudzbines.create'));

        $response->assertOk();
        $response->assertViewIs('porudzbine.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PorudzbineController::class,
            'store',
            \App\Http\Requests\PorudzbineStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $kupac = Kupac::factory()->create();
        $datum_porudzbine = Carbon::parse(fake()->date());
        $status = fake()->text();
        $ukupan_iznos = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('porudzbines.store'), [
            'kupac_id' => $kupac->id,
            'datum_porudzbine' => $datum_porudzbine->toDateString(),
            'status' => $status,
            'ukupan_iznos' => $ukupan_iznos,
        ]);

        $porudzbines = Porudzbine::query()
            ->where('kupac_id', $kupac->id)
            ->where('datum_porudzbine', $datum_porudzbine)
            ->where('status', $status)
            ->where('ukupan_iznos', $ukupan_iznos)
            ->get();
        $this->assertCount(1, $porudzbines);
        $porudzbine = $porudzbines->first();

        $response->assertRedirect(route('porudzbines.index'));
        $response->assertSessionHas('porudzbine.id', $porudzbine->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $porudzbine = Porudzbine::factory()->create();

        $response = $this->get(route('porudzbines.show', $porudzbine));

        $response->assertOk();
        $response->assertViewIs('porudzbine.show');
        $response->assertViewHas('porudzbine', $porudzbine);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $porudzbine = Porudzbine::factory()->create();

        $response = $this->get(route('porudzbines.edit', $porudzbine));

        $response->assertOk();
        $response->assertViewIs('porudzbine.edit');
        $response->assertViewHas('porudzbine', $porudzbine);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PorudzbineController::class,
            'update',
            \App\Http\Requests\PorudzbineUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $porudzbine = Porudzbine::factory()->create();
        $kupac = Kupac::factory()->create();
        $datum_porudzbine = Carbon::parse(fake()->date());
        $status = fake()->text();
        $ukupan_iznos = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('porudzbines.update', $porudzbine), [
            'kupac_id' => $kupac->id,
            'datum_porudzbine' => $datum_porudzbine->toDateString(),
            'status' => $status,
            'ukupan_iznos' => $ukupan_iznos,
        ]);

        $porudzbine->refresh();

        $response->assertRedirect(route('porudzbines.index'));
        $response->assertSessionHas('porudzbine.id', $porudzbine->id);

        $this->assertEquals($kupac->id, $porudzbine->kupac_id);
        $this->assertEquals($datum_porudzbine, $porudzbine->datum_porudzbine);
        $this->assertEquals($status, $porudzbine->status);
        $this->assertEquals($ukupan_iznos, $porudzbine->ukupan_iznos);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $porudzbine = Porudzbine::factory()->create();

        $response = $this->delete(route('porudzbines.destroy', $porudzbine));

        $response->assertRedirect(route('porudzbines.index'));

        $this->assertModelMissing($porudzbine);
    }
}
