<!-- Button trigger modal -->
<button hidden id="modalContrato" type="button" class="btn btn-primary modal-lg" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">DELETAR DADOS</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-responsive table align-items-center">
                    <tr>
                        <th>Deletar</th>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>CPF</th>
                        <th>DATA NASCIMENTO</th>
                        <th>TELEFONE</th>
                        <th>ENDERECO</th>
                        <th>ESTADO</th>
                        <th>CIDADE</th>
                    </tr>
                    @foreach($result as $item)
                    <tbody class="list">


                        <td>
                            <form id="deleteForm" action="{{ route('homeAjax.destroy', $item->id)}}" method="post">
                                @csrf @method('DELETE')
                                <button id="btnDelete" value="{{$item->id}}" onclick="return pergunta()" class="btn btn-danger" type="submit">Deletar</button>
                            </form>
                        </td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->nome}}</td>
                        <td>{{$item->cpf}}</td>
                        <td>{{$item->data_nascimento}}</td>
                        <td>{{$item->telefone}}</td>
                        <td>{{$item->endereco}}</td>
                        <td>{{$item->estado}}</td>
                        <td>{{$item->cidade}}</td>



                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function pergunta() {
        return confirm("deseja excluir este dado?")
    }
    $(document).ready(function() {
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#btnDelete').val();
            let url = '{{ route("homeAjax.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    alert('deletado')
                    location.reload();


                },
                error: function(error) {

                }
            })

        })
    })
</script>