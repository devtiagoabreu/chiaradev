<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // garante que só usuários logados podem acessar
    }

    // Listagem de usuários (opcional)
    public function index(Request $request)
    {
        $users = $request->input('user-search');
        if ($users) {
            $users = User::where('name', 'like', '%' . $users . '%')
                        ->orWhere('email', 'like', '%' . $users . '%')
                        ->get();
        } else {
            $users = User::all();
        }

        return view('dashboard.usuario.index', compact('users'));
    }

    // Formulário de criação
    public function create()
    {
        return view('dashboard.usuario.create');
    }

    // Armazenar novo usuário
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'O campo Nome Completo é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está registrado.',
            'password.required' => 'O campo Senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'acesso' => $request->acesso ?? 'user',
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($user){
        $user = User::where('id',$user)->first();
        return view('dashboard.usuario.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validação dos campos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,  // Verifica se o email não existe para outro usuário
            'password' => 'nullable|min:8|confirmed',  // Senha é opcional
        ], [
            'email.unique' => 'Este e-mail já está registrado com outro usuário.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        // Atualizando o usuário
        $user->name = $request->name;
        $user->email = $request->email;
        $user->acesso = $request->acesso ?? 'user';
        // Verifica se a senha foi alterada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if($user->id === 1 && $user->acesso === 'user'){
             return redirect()->route('usuario.index')->with('erro', 'Administrador não pode ser alterado nível de Acesso');
        }

        $user->save();

        return redirect()->route('usuario.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($user)
    {
        $usuario = User::where('id', $user)->first();

        if ($usuario->id === 1) {  // Impede a exclusão do Admin (usuário com ID 1)
            return redirect()->route('usuario.index')->with('erro', 'Usuário Admin não pode ser deletado');

        } else {
            $usuario->delete();  // Deleta o usuário
            return redirect()->route('usuario.index')->with('success', 'Usuário deletado com sucesso');
        }
    }


}
