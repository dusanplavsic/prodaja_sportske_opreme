<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\StavkePorudzbine;
use App\Models\Stavke_porudzbine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Stavke_porudzbineController
 */
final class Stavke_porudzbineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $stavkePorudzbines = Stavke_porudzbine::factory()->count(3)->create();

        $response = $this->get(route('stavke_porudzbines.index'));

        $response->assertOk();
        $response->assertViewIs('stavkePorudzbine.index');
        $response->assertViewHas('stavkePorudzbines', $stavkePorudzbines);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('stavke_porudzbines.create'));

        $response->assertOk();
        $response->assertViewIs('stavkePorudzbine.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Stavke_porudzbineController::class,
            'store',
            \App\Http\Requests\Stavke_porudzbineStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('stavke_porudzbines.store'));

        $response->assertRedirect(route('stavkePorudzbines.index'));
        $response->assertSessionHas('stavkePorudzbine.id', $stavkePorudzbine->id);

        $this->assertDatabaseHas(stavkePorudzbines, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $stavkePorudzbine = Stavke_porudzbine::factory()->create();

        $response = $this->get(route('stavke_porudzbines.show', $stavkePorudzbine));

        $response->assertOk();
        $response->assertViewIs('stavkePorudzbine.show');
        $response->assertViewHas('stavkePorudzbine', $stavkePorudzbine);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $stavkePorudzbine = Stavke_porudzbine::factory()->create();

        $response = $this->get(route('stavke_porudzbines.edit', $stavkePorudzbine));

        $response->assertOk();
        $response->assertViewIs('stavkePorudzbine.edit');
        $response->assertViewHas('stavkePorudzbine', $stavkePorudzbine);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Stavke_porudzbineController::class,
            'update',
            \App\Http\Requests\Stavke_porudzbineUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $stavkePorudzbine = Stavke_porudzbine::factory()->create();

        $response = $this->put(route('stavke_porudzbines.update', $stavkePorudzbine));

        $stavkePorudzbine->refresh();

        $response->assertRedirect(route('stavkePorudzbines.index'));
        $response->assertSessionHas('stavkePorudzbine.id', $stavkePorudzbine->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $stavkePorudzbine = Stavke_porudzbine::factory()->create();
        $stavkePorudzbine = StavkePorudzbine::factory()->create();

        $response = $this->delete(route('stavke_porudzbines.destroy', $stavkePorudzbine));

        $response->assertRedirect(route('stavkePorudzbines.index'));

        $this->assertModelMissing($stavkePorudzbine);
    }
}
