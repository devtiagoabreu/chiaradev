<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Garantia;
use App\Models\Whatsapp;
use App\Rules\CpfValido;


class GarantiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whatsapp = Whatsapp::first();
        $garantia = Garantia::first();

        return view('site.garantia.garantia',compact('whatsapp','garantia'));
    }

    public function indexApp(Request $request){

         $garantias = $request->input('search');
         
        if ($garantias) {
            $garantias = Garantia::where('cliente_nome', 'like', "%{$garantias}%")
                ->orWhere('cpf', 'like', "%{$garantias}%")
                ->orWhere('produto', 'like', "%{$garantias}%")
                ->get();
        } else {
            $garantias = Garantia::paginate(10);
        }

        // Passa os dados para a view
        return view('dashboard.garantia.index', compact('garantias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Copia os dados e limpa CPF/WhatsApp
        $data = $request->all();
        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        $data['whatsapp'] = preg_replace('/\D/', '', $data['whatsapp']);

        // Validação dos dados
        $validatedData = validator($data, [
            'nome_completo' => ['required','string','min:5','max:255','regex:/^\pL+(?:\s+\pL+)+$/u'],
            'cpf'                 => ['required', 'size:11', new CpfValido],
            'instagram'           => 'required|string|max:255',
            'produto_codigo'      => 'required|string|max:255',
            'data_da_compra'      => 'required|date',
            'nome_da_revendedora' => 'nullable|string|max:255',
            'whatsapp'            => 'required|string|max:20',
            'aceite_termos'       => 'accepted',
            'aceite_whatsapp'     => 'nullable',
        ], [
            'nome_completo.required'    => 'O nome completo é obrigatório.',
            'nome_completo.string'      => 'O nome deve conter apenas letras.',
            'nome_completo.regex'       => 'Digite seu nome completo (nome e sobrenome).',
            'nome_completo.string'      => 'O nome completo deve ser um texto válido.',
            'nome_completo.min'         => 'Quantidade mínima de caracter é 5.',
            'nome_completo.max'         => 'O nome completo deve ter no máximo 255 caracteres.',
            
            'cpf.required'              => 'Informe seu CPF.',
            'cpf.size'                  => 'O CPF deve conter exatamente 11 dígitos numéricos.',

            'instagram.required'        => 'Informe seu usuário do Instagram.',
            'instagram.string'          => 'O nome de usuário do Instagram deve ser uma string válida.',
            'instagram.max'             => 'O nome de usuário do Instagram não pode ter mais de 255 caracteres.',

            'produto_codigo.required'   => 'Informe o nome ou código da peça.',
            'data_da_compra.required'   => 'Informe a data da compra.',
            'data_da_compra.date'       => 'Informe uma data de compra válida.',
            'whatsapp.required'         => 'Informe seu número de WhatsApp.',
            'aceite_termos.accepted'    => 'Você deve aceitar os termos de garantia.',
        ])->validate();
            
        // Trata os checkboxes como booleanos
        $validatedData['aceite_termos'] = $request->has('aceite_termos') ? 1 : 0;
        $validatedData['aceite_whatsapp'] = $request->has('aceite_whatsapp') ? 1 : 0;

        Garantia::create($validatedData);

        return view('site.obrigado');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
