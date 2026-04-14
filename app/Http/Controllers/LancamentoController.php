<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lancamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\LancamentoCriado;

class LancamentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Lancamento::query();

        if ($request->data_inicio) {
            $query->where('data_lancamento', '>=', $request->data_inicio);
        }

        if ($request->data_fim) {
            $query->where('data_lancamento', '<=', $request->data_fim);
        }

        if ($request->situacao !== null && $request->situacao !== '') {
            $query->where('situacao', $request->situacao);
        }

        $lancamentos = $query->get();

        return view('lancamentos.index', compact('lancamentos'));
    }

    public function create()
    {
        return view('lancamentos.create');
    }

    public function store(Request $request)
    {
        // ✅ VALIDAÇÃO
        $request->validate([
            'descricao' => 'required',
            'data_lancamento' => 'required|date',
            'valor' => 'required|numeric',
            'tipo_lancamento' => 'required',
            'situacao' => 'required'
        ]);

        // ✅ CREATE
        $lancamento = Lancamento::create($request->all());

        // ✅ EMAIL
        try {
            Mail::to('gabriel.lussi@universo.univates.br')
                ->send(new LancamentoCriado($lancamento));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('/lancamentos')->with('success', 'Lançamento criado!');
    }

    public function edit($id)
    {
        $lancamento = Lancamento::findOrFail($id);
        return view('lancamentos.edit', compact('lancamento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required',
            'data_lancamento' => 'required|date',
            'valor' => 'required|numeric',
            'tipo_lancamento' => 'required',
            'situacao' => 'required'
        ]);

        $lancamento = Lancamento::findOrFail($id);
        $lancamento->update($request->all());

        try {
            Mail::to('gabriel.lussi@universo.univates.br')
                ->send(new LancamentoCriado($lancamento));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('/lancamentos')->with('success', 'Lançamento atualizado!');
    }

    public function destroy($id)
    {
        $lancamento = Lancamento::findOrFail($id);
        $lancamento->delete();

        return redirect('/lancamentos')->with('success', 'Lançamento excluído!');
    }

    public function exportPdf()
    {
        $lancamentos = Lancamento::all();
        $pdf = Pdf::loadView('lancamentos.pdf', compact('lancamentos'));

        return $pdf->download('lancamentos.pdf');
    }
}