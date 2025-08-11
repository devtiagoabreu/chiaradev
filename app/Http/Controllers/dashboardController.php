<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CliqueRedeSocial;
use App\Models\Garantia;
use App\Models\Revendedor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {
        // Total de cliques por origem (TikTok, Instagram, WhatsApp)
        $cliquesPorOrigem = CliqueRedeSocial::select(
            DB::raw('SUM(tiktok) as tiktok'),
            DB::raw('SUM(instagram) as instagram'),
            DB::raw('SUM(whatsapp) as whatsapp')
        )->first();

        // Verificando se o resultado é nulo
        $cliquesTikTok = $cliquesPorOrigem->tiktok ?? 0;
        $cliquesInstagram = $cliquesPorOrigem->instagram ?? 0;
        $cliquesWhatsapp = $cliquesPorOrigem->whatsapp ?? 0;

        // Total de cliques (somando todas as plataformas)
        $cliques = CliqueRedeSocial::select(DB::raw('SUM(tiktok + instagram + whatsapp) as total'))->first();
        $cliquesTotal = $cliques ? $cliques->total : 0;

        // Total de Garantias
        $garantia = Garantia::count();

        // Garantias dos Últimos 30 dias
        $garantiasUltimos30Dias = Garantia::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Revendedores Aprovados
        $revendedorAprovados = Revendedor::where('status', 'Aprovado')->count();

        // Dados de cliques (leads) por mês
        $cliquesPorMes = CliqueRedeSocial::select(DB::raw('MONTH(created_at) as mes'), DB::raw('SUM(tiktok + instagram + whatsapp) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('mes')
            ->get();
        // Preenchendo os meses com zero caso algum mês não tenha dados
        $leadsPorMes = [];
        for ($i = 1; $i <= 12; $i++) {
            $leadsPorMes[$i] = 0; // Inicia com 0 para todos os meses
        }

        // Atualiza os meses com dados reais
        foreach ($cliquesPorMes as $clique) {
            $leadsPorMes[$clique->mes] = $clique->total;
        }

        // Garantias por mês
        $garantiasPorMesQuery = Garantia::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        )->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('mes')
        ->get();

        // Inicializa todos os meses com 0
        $garantiasPorMes = [];
        for ($i = 1; $i <= 12; $i++) {
            $garantiasPorMes[$i] = 0;
        }

        // Preenche os meses com os dados reais
        foreach ($garantiasPorMesQuery as $registro) {
            $garantiasPorMes[$registro->mes] = $registro->total;
        }
        // Retornando os dados para a view
        return view('dashboard.index', compact(
            'cliquesTotal', 
            'garantia', 
            'garantiasUltimos30Dias', 
            'revendedorAprovados', 
            'cliquesTikTok', 
            'cliquesInstagram', 
            'cliquesWhatsapp', 
            'leadsPorMes',
            'garantiasPorMes',
        ));
    }
}
