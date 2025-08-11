<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Whatsapp;

class PrincipalController extends Controller
{
    public function index()
    {
        $whatsapp = Whatsapp::first();

        if ($whatsapp) {

            $telefone = $whatsapp->whatsapp;
            $tiktok = $whatsapp->tiktok;
            $instagram = $whatsapp->instagram;


            $mensagem_loja = $whatsapp->mensagem_loja;
            $mensagem_garantia = $whatsapp->mensagem_garantia;

            $mensagemCodificada_loja = urlencode($mensagem_loja);
            $mensagemCodificada_garantia = urlencode($mensagem_garantia);

            $linkWhatsapp_loja = "https://wa.me/$telefone?text=$mensagemCodificada_loja";
            $linkWhatsapp_garantia = "https://wa.me/$telefone?text=$mensagemCodificada_garantia";

        } else {
           
            $telefone = 'Número não disponível';
            $mensagem_loja = 'Mensagem não configurada';
            $mensagem_garantia = 'Mensagem não configurada';

            $linkWhatsapp_loja = "#";
            $linkWhatsapp_garantia = "#";
            $tiktok = '#';
            $instagram = '#';
        }
        
        return view('site.index', compact('whatsapp', 'linkWhatsapp_garantia', 'linkWhatsapp_loja','tiktok','instagram'));
    }
}
