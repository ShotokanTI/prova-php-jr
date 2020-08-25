<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\usuario;
use App\estados;
use App\cidades;
use App\role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $contrato = DB::table('usuario')->paginate(5);
        $total_rows = DB::table('usuario')->get();
        $total_rows = $total_rows->count() == 0;

        return view('index')->with(compact('contrato'))->with('total_rows', $total_rows);
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


        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|max:11',
            'data_nascimento' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'rolesSelect' => 'required'
        ]);

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

        //pegando array de roles
        $roles = $request->get('rolesSelect');

        for ($i = 0; $i < count($roles); $i++) {

            $role = new role([
                'role' => $roles[$i],
                'cpf' => $request->get('cpf'),
            ]);

            //retorna valores unicos para não ter duplicação na base de dados.
            $roles = array_unique($roles);
            //salva os roles e os cpfs
            $role->save();
        }
        return redirect('/')->with('status', 'Inclusão de contrato feito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
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

    public function search(Request $search)
    {
        // saber de onde está vindo a request root ou role
        $url = $search->fullUrl();
        $OriginRequest = strpos((string)$url, 'role');
        //se não for role,faz a busca para a pagina inicial
        if (!$OriginRequest) {
            $contrato = usuario::where('cpf', $search->get('search'))->orWhere('nome', 'like', '%' . $search->get('search') . '%')->paginate();

            $total_rows = $contrato->count();
            if ($total_rows <= 0) {
                return back()->with('error', 'O item buscado ' . $_GET['search'] . ' não existe no banco de dados');
            } else {
                $total_rows = false;
                return view('index', compact('contrato'))->with(compact('total_rows'));
            }
        }
        //se for role,faz a busca para a pagina role
        $role = role::where('role', 'like', '%' . $search->get('search') . '%')->orWhere('cpf', $search->get('search'))->paginate();

        $total_rows = $role->count();

        if ($total_rows <= 0) {
            return back()->with('error', 'O item buscado ' . $_GET['search'] . ' não existe no banco de dados');
        } else {
            $total_rows = false;
            return view('role', compact('role'))->with(compact('total_rows'));
        }
    }



    public function exibirRole()
    {
        $role = DB::table('roles')->paginate(5);
        $total_rows = DB::table('roles')->get();
        $total_rows = $total_rows->count() == 0;
        return view('role', ['role' => $role])->with(compact('total_rows'));
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

    public function updateRoles(Request $req)
    {
        $req->validate([
            'role' => 'required'
        ]);

        if (!empty($req->get('codigo_role'))) {
            $colunasRoles = array(
                'codigo_role' => $req->get('codigo_role'),
                'role' => $req->get('role'),
            );
        }
        if (isset($colunasRoles)) {
            foreach ($colunasRoles as $coluna => $valor) {
                role::where('codigo_role',$req->get('codigo_role'))->update([$coluna => $valor]);
            }
        }
        return redirect('/roles')->with('status', 'Edicao de usuario feito!');
    }

    public function updateTable(Request $req)
    {

        $req->validate([
            'nome' => 'required',
            'cpf' => 'required|max:11',
            'data_nascimento' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
        ]);

        if (!empty($req->get('id'))) {
            $estado = explode('|', $req->get('estado'));

            $colunas = array(
                'id' => $req->get('id'),
                'nome' => $req->get('nome'),
                'cpf' =>   $req->get('cpf'),
                'data_nascimento' =>  $req->get('data_nascimento'),
                'telefone' => $req->get('telefone'),
                'endereco' =>    $req->get('endereco'),
                'estado' => $estado[1],
                'cidade' => $req->get('cidade'),
            );
        }

        if (isset($colunas)) {
            foreach ($colunas as $coluna => $valor) {
                usuario::where('id', $req->get('id'))->update([$coluna => $valor]);
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


        $id = (string)$id;
        if (strlen($id) < 11) {
            role::where('codigo_role', $id)->delete();
            return redirect('/roles')->with('status', 'Exclusão bem sucedida');
        } else {
            usuario::where('cpf', $id)->delete();
            return redirect('/')->with('status', 'Exclusão bem sucedida');
        }
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

    public function addRole(Request $request)
    {
        $roles = $request->get('rolesSelect');

        for ($i = 0; $i < count($roles); $i++) {
            $role = new role([
                'role' => $roles[$i],
                'cpf' => $request->get('cpf'),
            ]);

            $achoucpf = usuario::where('cpf', $request->get('cpf'))->get();
            $achourole = role::where('role', $roles[$i])->get();


            if ($achoucpf->count() <= 0) {
                return back()->with('error', 'O CPF inserido ' . $request->get('cpf') . ' não existe no banco de dados portando não é possivel relacionar com o role ' . $roles[$i]);
            } else if ($achourole->count() > 0 && $achoucpf->count() > 0) {
                return back()->with('error', 'O Role '.$roles[$i]. ' para este cpf já existe no banco de dados');
            } else {
                $role->save();
            }
        }
        return redirect('/roles')->with('status', 'Inclusão de contrato feito!');
    }
}
