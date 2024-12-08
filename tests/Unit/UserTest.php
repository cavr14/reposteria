<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_user()
    {
        // Definir los datos del nuevo usuario
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'), // Asegúrate de que la contraseña esté en texto plano, porque será cifrada
            'password_confirmation' => bcrypt('password'),  // Asegúrate de incluir la confirmación de contraseña
        ];

        // Enviar la solicitud POST a la ruta 'register' que se utiliza para crear el usuario
        $response = $this->post(route('register'), $userData);

        // Verificar que el usuario ha sido creado y la redirección es la esperada
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        // Verifica que la redirección sea la correcta (puedes ajustar la ruta según la lógica del controlador)
        $response->assertRedirect(route('register.success'));
    }
}
