<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CliqueRedeSocial;

class CliquesRedeSocialController extends Controller
{
    public function registrarClique(Request $request)
    {
        // Validação correta do campo 'platform'
        $validated = $request->validate([
            'platform' => 'required|in:instagram,tiktok,whatsapp',
        ]);

        $platform = $validated['platform'];

        // Tenta buscar o primeiro registro ou cria um novo
        $cliques = CliqueRedeSocial::first(); // Retorna o primeiro registro ou null

        if (!$cliques) {
            // Se não existir um registro, cria um novo
            $cliques = CliqueRedeSocial::create([
                'instagram' => 0,
                'tiktok' => 0,
                'whatsapp' => 0,
            ]);
        }

        // Incrementa o contador da plataforma
        $cliques->increment($platform);

        return response()->json(['status' => 'clique registrado']);
    }


}
