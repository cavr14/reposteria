<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function create()
    {
        return view('auth.login'); // Asegúrate de tener la vista 'auth.login'
    }
    public function store(LoginRequest $request)
    {
        // Intenta autenticar al usuario
        $request->authenticate();

        // Regenera la sesión para mayor seguridad
        $request->session()->regenerate();

        // Redirige según el tipo de usuario
        $user = Auth::user();
        if ($user->is_admin) {
            // Si es administrador, redirige a la página de administrador
            return redirect()->route('admin.home');
        } else {
            // Si es cliente, redirige a la página de cliente
            return redirect()->route('client.home');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        // Realiza logout del usuario
        Auth::guard('web')->logout();

        // Invalida la sesión y regenera el token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Responde con no content
        return response()->noContent();
    }
}

