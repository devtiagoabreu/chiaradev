<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Smtp;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            // Verifica se a conexão com o banco de dados foi bem-sucedida
            DB::connection()->getPdo();

            // Agora que a conexão foi estabelecida, podemos acessar o banco de dados
            if (Schema::hasTable('smpt')) { // Substitua 'smptes' pelo nome correto da tabela
                $smtp = Smtp::first();

                if ($smtp) {
                    // Configuração do SMTP
                    Config::set('mail.mailers.smtp.host', $smtp->host);
                    Config::set('mail.mailers.smtp.port', (int) $smtp->port);
                    Config::set('mail.mailers.smtp.encryption', $smtp->encryption);
                    Config::set('mail.mailers.smtp.username', $smtp->username);
                    Config::set('mail.mailers.smtp.password', $smtp->password);
                    Config::set('mail.from.address', $smtp->from_address);
                    Config::set('mail.from.name', config('app.name'));
                }
            } else {
                Log::warning('A tabela "smpt" não existe. Não foi possível configurar o SMTP.');
            }
        } catch (\Exception $e) {
            // Se a conexão falhar, loga o erro
            Log::error('Erro ao conectar ao banco de dados: ' . $e->getMessage());
        }
    }
}
