<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;

class controllerAgenda extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Agenda::all();
        return view('exibirContatos', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('novoContato');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = new Agenda();
        $dados->nomeContato = $request->input('nomeContato');
        $dados->telContato = $request->input('telContato');
        $dados->emailContato = $request->input('emailContato');
        $dados->save();
        return redirect('/contatos')->with('success', 'Novo contato cadastrado com sucesso.');
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
        $dados = Agenda::find($id);
        if(isset($dados)){
            return view('editarContato', compact('dados'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dados = Agenda::find($id);
        if(isset($dados)){
            $dados->nomeContato = $request->input('nomeContato');
            $dados->telContato = $request->input('telContato');
            $dados->emailContato = $request->input('emailContato');
            $dados->save();
            return redirect('/contatos')->with('success', 'Contato atualizado com sucesso.');
        }
        return redirect('/contatos')->with('danger', 'Erro ao tentar atualizar contato.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dados = Agenda::find($id);
        if(isset($dados)){
            $dados->delete();
            return redirect('/contatos')->with('success', 'Contato deletado com sucesso.');
        }
        return redirect('/contatos')->with('danger', 'Erro ao tentar deletar contato.');
    }

    public function pesquisarContato(){
        return view('pesquisaContato');
    }

    public function procurarContato(Request $request){
        $nome = $request->input('nomeContato');
        $dados = DB::table('agendas')->select('id', 'nomeContato', 'telContato', 'emailContato')
                 ->where(DB::raw('lower(nomeContato)'), 'like', '%' . strtolower($nome) . '%')->get();
        return view('exibirContatos', compact('dados'));
    }
}