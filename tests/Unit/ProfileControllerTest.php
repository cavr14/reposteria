<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_user_name_correctly()
    {
        // Crear un usuario ficticio
        $user = User::factory()->create([
            'name' => 'Nombre Original',
        ]);

        // Simular inicio de sesión del usuario
        $this->actingAs($user);

        // Datos para la actualización
        $data = [
            'name' => 'Nombre Actualizado',
        ];

        // Realizar una solicitud PUT para actualizar el perfil
        $response = $this->put(route('client.settings.update'), $data);

        // Verificar que la redirección fue exitosa
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Perfil actualizado con éxito');

        // Verificar los cambios en la base de datos
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nombre Actualizado',
        ]);
    }
}
