<x-argon-css />
<style>
   body {
      background-color: #ffff;
   }
</style>
<title>CRUD ZIPP</title>
<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="https://comprezipp.com/favicon.ico">
@include('layouts.navbars.navs.auth')
<x-modal_role_edit />
<div class="container-fluid" style="padding-top:8vw">
   <div class="container">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div style="background-color:#AF0606" class="alert" role="alert" data-dismiss="alert">
         <h3 style="color:#fff">{{ $error }}</h3>
      </div>
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
               <h2>Administre <b>seus roles</b></h2>
            </div>
            <div class="col-6">
               <div style="float:right;">
                  <form method="get" action="{{ route('search') }}">
                     <div style="display:flex">
                        @csrf
                        <button style="background-color: #111;" type="button" class="btn" data-toggle="modal" data-target="#modalRole">
                           <i class="fas fa-plus-circle"></i> Adicionar role
                        </button>
                        <input type="text" hidden value="role" name="role">
                        <input name="search" style="display:inline;width:15vw" id="tableSearch" class="form-control" type="text" placeholder="Buscar por role ou cpf" aria-label="Search">
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
            <th>Codigo_role</th>
            <th>ROLE</th>
            <th>CPF</th>
            <th>Ações</th>
         </tr>
      </thead>
      <tbody class="list">

         @if($total_rows)
         <td style="font-size:1em;color:#A6A619">Nenhuma informação na base de dados <i class="fas fa-exclamation-triangle"></i></td>
         @else
         @foreach($role as $item)
         <td>{{$item->codigo_role}}</td>
         <td>{{$item->role}}</td>
         <td>{{$item->cpf}}</td>
         <td>
            <button href="#modalAdicionarRoles{{$item->codigo_role}}" class="edit btn btn-primary" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></button>
            <form style="display:inline" method="post" id="deleteForm" action="{{ route('homeAjax.destroy', $item->codigo_role)}}">
               @csrf @method('DELETE')
               <button title="Deletar" id="btnDelete" value="{{$item->codigo_role}}" onclick="return pergunta()" class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
            </form>
         </td>
      </tbody>
      <div id="modalAdicionarRoles{{$item->codigo_role}}" class="modal fade">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-body">
                  <form method="POST" action="{{route('homeAjax/updateRoles')}}" enctype="multipart/form-data">
                     @csrf
                     <div class="modal-header">
                        <h4 class="modal-title">Editar Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     </div>
                     <input hidden type="text" class="form-control" name="codigo_role" value="{{$item->codigo_role}}">
                     <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" name="role" value="{{$item->role}}">
                     </div>
                     <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      @endforeach
      @endif

   </table>
   <div class="clearfix">
      <div class="hint-text">Exibindo <b>{{$role->lastItem()}}</b> de <b>{{$role->total()}}</b> linhas</div>
      <ul class="pagination">
         {{$role->links()}}
      </ul>
   </div>
</div>
@include('layouts.footers.nav')
<x-argon-js />