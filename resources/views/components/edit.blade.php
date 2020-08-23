<!-- Button trigger modal -->
<button hidden id="editModal" type="button" class="btn btn-primary modal-lg" data-toggle="modal" data-target="#ModalEdit">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title" id="exampleModalLabel">Edite seus registros aqui</h1>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(isset($contrato))
            <div style="text-align: center;padding-top:3vw">
                <h1>Tabela de usuarios</h1>

            </div>
            @foreach($contrato as $item)
            <div class="modal-body">

                <form method="post" action="{{route('homeAjax/updateTable')}}" enctype="multipart/form-data">
                    @csrf


                    <table class="table-responsive table align-items-center">

                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CPF</th>
                            <th>DATA NASCIMENTO</th>
                            <th>TELEFONE</th>
                            <th>ENDERECO</th>
                            <th>ESTADO</th>
                            <th>CIDADE</th>
                        </tr>

                        <tbody class="list">
                            <td><input style="display:none" name="id[]" value="{{$item->id}}" />{{$item->id}}</td>
                            <td><input name="nome[]" value="{{$item->nome}}" /></td>
                            <td><input name="cpf[]" value="{{$item->cpf}}" /></td>
                            <td><input type='date' name="data_nascimento[]" value="{{$item->data_nascimento}}" /></td>
                            <td><input name="telefone[]" value="{{$item->telefone}}" /></td>
                            <td><input name="endereco[]" value="{{$item->endereco}}" /></td>
                            <td><input name="estado[]" value="{{$item->estado}}" /></td>
                            <td><input name="cidade[]" value="{{$item->cidade}}" /></td>
                        </tbody>
                    </table>
                    @endforeach
                    @endif

                    <div style="text-align: center;padding-top:3vw">
                        <h1>Tabela de roles</h1>
                    </div>
                    @if(isset($role))
                    @foreach($role as $item)
                    <div style="padding-left:5vw">
                        <table class="table-responsive table align-items-center">

                            <tr>
                                <th>Codigo_role</th>
                                <th>ROLE</th>
                                <th>CPF</th>
                            </tr>

                            <tbody class="list">
                                <td><input style="display:none" name="codigo_role[]" value="{{$item->codigo_role}}" />{{$item->codigo_role}}</td>
                                <td><input name="role[]" value="{{$item->role}}" /></td>
                                <td><input name="cpf[]" value="{{$item->cpf}}" /></td>
                            </tbody>
                        </table>
                    </div>

                    @endforeach
                    @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </div>

    </div>
</div>