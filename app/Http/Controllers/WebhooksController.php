<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function handleGitHubWebhook(Request $request)
    {
        // Procesar la carga útil del webhook
        $payload = $request->all();

        // Aquí puedes agregar la lógica para manejar el evento del webhook
        // Por ejemplo, puedes registrar el evento en un archivo de log
        \Log::info('GitHub Webhook received:', $payload);

        return response()->json(['status' => 'success'], 200);
    }
}