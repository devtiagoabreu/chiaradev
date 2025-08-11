<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revendedor;
use App\Rules\CpfValido;


class RevendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.revendedor.revendedor');
    }

  public function indexApp(Request $request)
{
    // Recupera os parâmetros de busca e status, se houverem
    $search = $request->input('search');
    $status = $request->input('status');

    // Inicia a consulta
    $revendedores = Revendedor::query();

    // Filtro de busca por nome, telefone, cidade, estado ou CPF
    if ($search) {
        $revendedores = $revendedores->where(function($query) use ($search) {
            $query->where('nome_completo', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%")
                  ->orWhere('cidade_estado', 'like', "%{$search}%")
                  ->orWhere('cpf', 'like', "%{$search}%");
        });
    }

    // Filtro por status, se fornecido
    if ($status !== null) {
        $revendedores = $revendedores
            ->where('status', $status);
    }

     // Ordenação personalizada por status
    $revendedores = $revendedores->orderByRaw("FIELD(status, 'Pendente','Aprovado', 'Rejeitado')");

    // Executa a consulta
    $revendedores = $revendedores->paginate(10);

    // Retorna a view com os revendedores filtrados
    return view('dashboard.revendedor.index', compact('revendedores'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.revendedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Limpa o CPF e WhatsApp primeiro
        $cpfLimpo = preg_replace('/\D/', '', $request->input('cpf'));
        $whatsappLimpo = preg_replace('/\D/', '', $request->input('whatsapp'));

        // Monta um array com os dados já limpos para validar
        $data = $request->all();
        $data['cpf'] = $cpfLimpo;
        $data['whatsapp'] = $whatsappLimpo;

        $validated = validator($data, [
            'nome_completo' => ['required','string','min:5','max:255','regex:/^\pL+(?:\s+\pL+)+$/u'],
            'cpf' => ['required', 'size:11', 'unique:revendedor,cpf', new CpfValido],
            'cidade_estado'       => 'required|string|max:255',
            'whatsapp'            => 'required|string|max:20',
            'instagram'           => 'required|string|max:255',
            // 'interesse'           => 'required|in:Comprar,Revender,Ambos',
        ], [
            'nome_completo.required'    => 'O nome completo é obrigatório.',
            'nome_completo.string'      => 'O nome deve conter apenas letras.',
            'nome_completo.regex'       => 'Digite seu nome completo (nome e sobrenome).',
            'nome_completo.string'      => 'O nome completo deve ser um texto válido.',
            'nome_completo.min'         => 'Quantidade mínima de caracter é 5.',
            'nome_completo.max'         => 'O nome completo deve ter no máximo 255 caracteres.',

            'cpf.required'              => 'O CPF é obrigatório.',
            'cpf.size'                  => 'O CPF deve conter exatamente 11 dígitos numéricos.',
            'cpf.unique'                => 'O CPF informado já existe em um cadastro.',

            'cidade_estado.required'    => 'A cidade e o estado são obrigatórios.',
            'cidade_estado.string'      => 'A cidade/estado deve ser um texto válido.',
            'cidade_estado.max'         => 'A cidade/estado deve ter no máximo 255 caracteres.',

            'whatsapp.required'         => 'O número do WhatsApp é obrigatório.',
            'whatsapp.string'           => 'O número do WhatsApp deve ser um texto válido.',
            'whatsapp.max'              => 'O número do WhatsApp deve ter no máximo 20 caracteres.',

            'instagram.required'        => 'Informe seu usuário do Instagram.',
            'instagram.string'          => 'O nome de usuário do Instagram deve ser uma string válida.',
            'instagram.max'             => 'O nome de usuário do Instagram não pode ter mais de 255 caracteres.',

            // 'interesse.required'        => 'O campo de interesse é obrigatório.',
        ])->validate();

        Revendedor::create($validated);

        return view('site.obrigado');
    }

    public function storeApp(Request $request)
    {
        // Limpa o CPF e WhatsApp primeiro
        $cpfLimpo = preg_replace('/\D/', '', $request->input('cpf'));
        $whatsappLimpo = preg_replace('/\D/', '', $request->input('whatsapp'));

        // Monta um array com os dados já limpos para validar
        $data = $request->all();
        $data['cpf'] = $cpfLimpo;
        $data['whatsapp'] = $whatsappLimpo;

        $validated = validator($data, [
            'nome_completo' => ['required','string','min:5','max:255','regex:/^\pL+(?:\s+\pL+)+$/u'],
            'cpf' => ['required', 'size:11', 'unique:revendedor,cpf', new CpfValido],
            'cidade_estado'       => 'required|string|max:255',
            'whatsapp'            => 'required|string|max:20',
            'instagram'           => 'required|string|max:255',
            // 'interesse'           => 'required|in:Comprar,Revender,Ambos',
        ], [
            'nome_completo.required'    => 'O nome completo é obrigatório.',
            'nome_completo.string'      => 'O nome deve conter apenas letras.',
            'nome_completo.regex'       => 'Digite seu nome completo (nome e sobrenome).',
            'nome_completo.string'      => 'O nome completo deve ser um texto válido.',
            'nome_completo.min'         => 'Quantidade mínima de caracter é 5.',
            'nome_completo.max'         => 'O nome completo deve ter no máximo 255 caracteres.',

            'cpf.required'              => 'O CPF é obrigatório.',
            'cpf.size'                  => 'O CPF deve conter exatamente 11 dígitos numéricos.',
            'cpf.unique'                => 'O CPF informado já existe em um cadastro.',

            'cidade_estado.required'    => 'A cidade e o estado são obrigatórios.',
            'cidade_estado.string'      => 'A cidade/estado deve ser um texto válido.',
            'cidade_estado.max'         => 'A cidade/estado deve ter no máximo 255 caracteres.',

            'whatsapp.required'         => 'O número do WhatsApp é obrigatório.',
            'whatsapp.string'           => 'O número do WhatsApp deve ser um texto válido.',
            'whatsapp.max'              => 'O número do WhatsApp deve ter no máximo 20 caracteres.',

            'instagram.required'        => 'Informe seu usuário do Instagram.',
            'instagram.string'          => 'O nome de usuário do Instagram deve ser uma string válida.',
            'instagram.max'             => 'O nome de usuário do Instagram não pode ter mais de 255 caracteres.',

            // 'interesse.required'        => 'O campo de interesse é obrigatório.',
        ])->validate();

        Revendedor::create($validated);

        return redirect()->route('app.revendedor.index')->with('success','Revendedor cadastrado com sucesso');
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
        // Encontrar o revendedor pelo ID
        $revendedor = Revendedor::findOrFail($id);

        // Passar os dados para a view
        return view('dashboard.revendedor.edit', compact('revendedor'));
    }
    
    public function aprovar($id)
    {
        // Encontre o revendedor pelo ID
        $revendedor = Revendedor::findOrFail($id);

        // Atualize o status para "Aprovado"
        $revendedor->update(['status' => 'Aprovado']);

        // Redirecione para a lista de revendedores com uma mensagem de sucesso
        return redirect()->route('app.revendedor.index')->with('success', 'Revendedor aprovado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome_completo' => ['required', 'string', 'min:5', 'max:255', 'regex:/^\pL+(?:\s+\pL+)+$/u'],
            'cpf' => ['required', 'size:11', 'unique:revendedor,cpf,' . $id, new CpfValido],  // A exceção unique ignora o próprio CPF
            'cidade_estado' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'instagram' => 'nullable|string|max:255',  // Instagram é opcional
            'tipo_vendedor' => 'required|in:Varejo,Atacado',
            'status' => 'required|string|in:Pendente,Aprovado,Rejeitado',

        ]);

        // Encontrar o revendedor pelo ID
        $revendedor = Revendedor::findOrFail($id);

        // Atualizar os dados
        $revendedor->update([
            'nome_completo' => $request->input('nome_completo'),
            'cpf' => $request->input('cpf'),
            'whatsapp' => $request->input('whatsapp'),
            'cidade_estado' => $request->input('cidade_estado'),
            'instagram' => $request->input('instagram'),
            'tipo_vendedor' => $request->input('tipo_vendedor'),
            'status' => $request->input('status')
        ]);

        // Redirecionar de volta para a lista de revendedores com uma mensagem de sucesso
        return redirect()->route('app.revendedor.index')->with('success', 'Revendedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $revendedor = Revendedor::where('id',$id)->first();
        $revendedor->delete();
        return redirect()->route('app.revendedor.index')->with('success','Vendedor excluido com sucesso');
    }
}
