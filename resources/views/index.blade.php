<style>
   body {
   background-color: #fff !important;
   }
</style>
@extends('base')
@section('main')
<x-argon-css />
@include('layouts.navbars.navbar')
@include('home')
<div id="Usuario" style="padding-top:8vw;">
   <div class="container">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div style="background-color:#AF0606;position:absolute;top:5vw" class="alert" role="alert" data-dismiss="alert">
         <h3 style="color:#fff">{{ $error }}</h3>
      </div>
      @endforeach
      @endif
   </div>
   <div class="table-responsive">
      @if (session('error'))
      <span style="color: red;padding-left: 9vw;font-size:0.7vw;max-width:0.9vw">{{ session('error') }}</span>
      @endif
      <div class="table-wrapper">
         <div class="table-title" style="background-color: white!important;">
            <div class="row">
               <div class="col-6">
                  <h2>Administre <b>seus usuarios</b></h2>
               </div>
               <div class="col-6">
                  <div style="float:right;">
                     <form method="get" action="{{ route('search') }}">
                        <div style="display:flex">
                           @csrf
                           <button style="background-color: #111;" id="addModal" type="button" class="btn" data-toggle="modal" data-target="#addModal">
                           <i class="fas fa-plus-circle"></i> Adicionar usuario
                           </button>
                           <input name="search" style="display:inline;width:15vw" id="tableSearch" class="form-control" type="text" placeholder="Buscar por cpf ou nome" aria-label="Search">
                           <button style="background-color: #111;" class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <table class="table table-striped table-hover">
         <thead>
            <tr>
               <th>ID</th>
               <th>NOME</th>
               <th>CPF</th>
               <th>DATA NASCIMENTO</th>
               <th>TELEFONE</th>
               <th>ENDERECO</th>
               <th>ESTADO</th>
               <th>CIDADE</th>
               <th>Ações</th>
            </tr>
         </thead>
         <tbody class="list">
            @if($total_rows)
            <td style="font-size:1em;color:#A6A619">Nenhuma informação na base de dados <i class="fas fa-exclamation-triangle"></i></td>
            @else
            @foreach($contrato as $item)
            <td>{{$item->id}}</td>
            <td>{{$item->nome}}</td>
            <td>{{$item->cpf}}</td>
            <td>{{$item->data_nascimento}}</td>
            <td>{{$item->telefone}}</td>
            <td>{{$item->endereco}}</td>
            <td>{{$item->estado}}</td>
            <td>{{$item->cidade}}</td>
            <td>
               <button href="#editEmployeeModal{{$item->id}}" class="edit btn btn-primary" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></button>
               <form style="display:inline" method="post" id="deleteForm" action="{{ route('homeAjax.destroy', $item->cpf)}}">
                  @csrf @method('DELETE')
                  <button id="btnDelete" value="{{$item->cpf}}" onclick="return pergunta()" class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
               </form>
            </td>
         </tbody>
         <div id="editEmployeeModal{{$item->id}}" class="modal fade">
            <div class="modal-dialog">
               <div class="modal-content">
                  <form method="POST" action="{{route('homeAjax/updateTable')}}" enctype="multipart/form-data">
                     @csrf
                     <div hidden>
                        <input type="text" name="id" value="{{$item->id}}">
                     </div>
                     <div class="modal-header">
                        <h4 class="modal-title">Editar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="form-group">
                           <label>Name</label>
                           <input type="text" name="nome" value="{{$item->nome}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label>CPF</label>
                           <input readonly type="cpf" name="cpf" value="{{$item->cpf}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label>Data nascimento</label>
                           <input type="date" value="{{$item->data_nascimento}}" name="data_nascimento" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label>Telefone</label>
                           <input type="text" value="{{$item->telefone}}" name="telefone" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label>Endereço</label>
                           <input type="text" value="{{$item->endereco}}" name="endereco" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label>Edite seu Estado</label>
                           <select id="estados" class="form-control estados" name="estado">
                           </select>
                        </div>
                        <div  style="display:none" class="form-group fieldCidadesEdit">
                           <label>Edite sua cidade</label>
                           <select class="form-control cidadesEdit" name="cidade">
                              <option value="*">Selecione sua cidade</option>
                           </select>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         @endforeach
         @endif
      </table>
      <div class="clearfix">
         <div class="hint-text">Exibindo <b>{{$contrato->lastItem()}}</b> de <b>{{$contrato->total()}}</b> linhas</div>
         <ul class="pagination">
            {{$contrato->links()}}
         </ul>
      </div>
   </div>
</div>
<script>
   $.ajax({
       type: 'GET',
       url: "{{route('backEstados')}}",
       success: function(data) {
           // $('#estado').html(data);
           for (i in data) {
               $('.estados').append(`<option value=${data[i]['id']}|${data[i]['sigla']}>${data[i]['sigla']}</option>`)
           }
       },
   
   });
   
   //popular cidades dependendo do estado que estiver selecionado
   $('.estados').change(function() {
   
       let valorEstadoEscolhido = $(this).val()
       console.log(valorEstadoEscolhido)
       let url = '{{ route("backCidades", ":id") }}';
       url = url.replace(':id', valorEstadoEscolhido);
       $.ajax({
           type: 'GET',
           url: url,
           success: function(data) {
              console.log(data)
               $('.cidadesEdit').html('')
               for (i in data) {
                   $('.cidadesEdit').append(`<option value="${data[i]['cidade']}">${data[i]['cidade']}</option>`)
               }
           },
       });
       $('.fieldCidadesEdit').show()
   })
</script>
@include('layouts.footers.nav')
@endsection