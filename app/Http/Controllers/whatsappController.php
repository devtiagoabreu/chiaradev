<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\whatsapp;

class whatsappController extends Controller
{
    public function whatsapp(Request $request)
    {
        $whatsapp = whatsapp::first();
        
        return view('dashboard.configuracao.links.whatsapp',compact('whatsapp'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'whatsapp' => 'nullable|string',
            'mensagem_garantia' => 'nullable|string',
            'mensagem_loja' => 'nullable|string',
            'instagram' => 'nullable|string',
            'tiktok' => 'nullable|string',
        ]);

        // Atualiza o primeiro registro ou cria um novo
        Whatsapp::updateOrCreate([], $data);

        return redirect()->route('whatsapp')->with('success', 'Configurações salvas com sucesso!');
    }
}
