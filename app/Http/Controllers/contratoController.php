<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\usuario;
use App\estados;
use App\cidades;
use App\role;
use Illuminate\Http\Request;

class contratoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $request->validate([
        //     'nome' => 'required',
        //     'cpf' => 'required|max:11',
        //     'data_nascimento' => 'required',
        //     'telefone' => 'required',
        //     'endereco' => 'required',
        //     'estado' => 'required',
        //     'cidade' => 'required',
        // ]);

        $estado = explode('|', $request->get('estado'));

        $contrato = new usuario([
            'nome' => $request->get('nome'),
            'cpf' =>   $request->get('cpf'),
            'data_nascimento' =>  $request->get('data_nascimento'),
            'telefone' => $request->get('telefone'),
            'endereco' =>    $request->get('endereco'),
            'estado' =>  $estado[1],
            'cidade' => $request->get('cidade')
        ]);
        
        $contrato->save();

        $roles = $request->get('rolesSelect');
        for($i=0; $i<count($roles); $i++){
        $role = new role([
            'role' => $roles[$i],
            'cpf' => $request->get('cpf'),
        ]);
            $role->save();
        }
        return redirect('home')->with('status', 'Inclusão de contrato feito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $escolhido)
    {

        function formatCnpjCpf($id)
        {
            $cnpj_cpf = preg_replace("/\D/", '', $id);

            if (strlen($cnpj_cpf) === 11) {
                return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
            }

            return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
        }
        // $cnpj = $id->get('cnpj');
        // $razaosocial = $id->get('razaosocial');
        // $nomefantasia = $id->get('nomefantasia');


        $escolhido = $escolhido->get('escolhido');
        if ($escolhido == 'cnpj') {
            $id = formatCnpjCpf($id);
        }
        // $busca = array('cnpj' => $cnpj, 'razao_social' => $razaosocial, 'nome_fantasia' => $nomefantasia);

        // foreach ($busca as $key => $buscar) {

        //     if ($buscar != '') {

        if (!is_null($result = usuario::where($escolhido, $id)->get()->first())) {
            $result = usuario::where($escolhido, $id)->get();
            return view('components.search', compact('result'));
        } else {

            return view('components.form-search', compact('escolhido'));
        }
        // }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }
    public function exibir()
    {
        $contrato = usuario::all();
        $role = role::all();
        return view('components.edit', compact('contrato','role'));
    }

    public function exibirDelete()
    {
        $result = usuario::all();

        return view('components.modal-pesquisa', compact('result'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    public function updateTable(Request $req)
    {
        // if ($req->hasFile('logomarca')) {
        //     foreach ($req->file('logomarca') as $item) {
        //         $filename = time() . '_' . $item->getClientOriginalName();
        //         $item->move('public/logomarca', $filename);
        //     }
        // }

        $colunas = array(
            'id' => $req->get('id'),
            'nome' => $req->get('nome'),
            'cpf' =>   $req->get('cpf'),
            'data_nascimento' =>  $req->get('data_nascimento'),
            'telefone' => $req->get('telefone'),
            'endereco' =>    $req->get('endereco'),
            'estado' => $req->get('estado'),
            'cidade' => $req->get('cidade'),
        );

        $colunasRoles = array(
            'codigo_role' => $req->get('codigo_role'),
            'role' => $req->get('role'),
            'cpf' => $req->get('cpf'),
        );

        $colunas = json_encode($colunas);
        $colunas = json_decode($colunas, true);

        for ($i = 0; $i < count($colunas['id']); $i++) {
            foreach ($colunas as $coluna => $valor) {
                usuario::where('id', $colunas['id'][$i])->update([$coluna => $valor[$i]]);
            }
        }

        $colunasRoles = json_encode($colunasRoles);
        $colunasRoles = json_decode($colunasRoles, true);

        for ($i = 0; $i < count($colunasRoles['codigo_role']); $i++) {
            foreach ($colunasRoles as $coluna => $valor) {
                role::where('codigo_role', $colunasRoles['codigo_role'][$i])->update([$coluna => $valor[$i]]);
            }
        }

        return redirect('/')->with('status', 'Edicao de usuario feito!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contrato = usuario::where('id', $id)->delete();

        // return redirect('/home')->with('status','Exclusão bem sucedida');
        return $contrato;
    }


    public function backEstados()
    {
        $result = estados::all();

        return $result;
    }

    public function backCidadesByEstado($idEstado)
    {
        $result = cidades::where('estado_id', $idEstado)->get();
        return $result;
    }
}
