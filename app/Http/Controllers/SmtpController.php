<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smtp;

class SmtpController extends Controller
{
   public function smtp()
    {
        $smtp = Smtp::first();
        return view('dashboard.configuracao.smtp.smtp', compact('smtp'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'host' => ['required', 'string', 'regex:/^([a-zA-Z0-9\-\.]+)$/'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'encryption' => ['nullable', 'string', 'in:tls,ssl,'],
            'username' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['nullable', 'string', 'min:3', 'max:255'],
            'from_address' => ['required', 'email'],
        ], [
            'host.required' => 'O servidor SMTP (host) é obrigatório.',
            'host.string' => 'O servidor SMTP deve ser um texto válido.',
            'host.regex' => 'O servidor SMTP contém caracteres inválidos. Use apenas letras, números, pontos e hífens.',

            'port.required' => 'A porta é obrigatória.',
            'port.integer' => 'A porta deve ser um número inteiro.',
            'port.between' => 'A porta deve estar entre 1 e 65535.',

            'encryption.string' => 'O tipo de criptografia deve ser um texto válido.',
            'encryption.in' => 'A criptografia deve ser "tls", "ssl" ou estar vazia.',

            'username.required' => 'O usuário SMTP é obrigatório.',
            'username.string' => 'O usuário SMTP deve ser um texto válido.',
            'username.min' => 'O usuário SMTP deve ter ao menos 3 caracteres.',
            'username.max' => 'O usuário SMTP não pode ultrapassar 255 caracteres.',

            'password.required' => 'A senha SMTP é obrigatória.',
            'password.string' => 'A senha SMTP deve ser um texto válido.',
            'password.min' => 'A senha SMTP deve ter ao menos 3 caracteres.',
            'password.max' => 'A senha SMTP não pode ultrapassar 255 caracteres.',

            'from_address.required' => 'O endereço de remetente é obrigatório.',
            'from_address.email' => 'Informe um e-mail válido para o remetente.',
        ]);


        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        Smtp::updateOrCreate(['id' => 1], $validated);

        return redirect()->route('smtp')->with('success', 'Configurações salvas com sucesso!');
    }
}
