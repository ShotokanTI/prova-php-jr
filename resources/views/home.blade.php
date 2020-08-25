<div id="addModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div>
                <div id="modalPesquisa">
                </div>
                <div id="modalEdit">

                </div>
                <x-header />

                <script>
                    if ('{{session("status")}}') {
                        alert('{{session("status")}}')
                    }
                </script>

                <div class='card-body px-lg-3 py-lg-1'>

                    <form id="formContrato" method="post" action="{{ route('homeAjax.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!--NOME-->
                        <div class="row">
                            <div class="form-group col-6">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                    </div>
                                    <input class="form-control dados" placeholder="NOME" type="text" name="nome">
                                </div>
                            </div>

                            <!--CPF-->
                            <div class="form-group col-6">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                    </div>
                                    <input class="form-control dados" placeholder="CPF" type="text" name="cpf">
                                    <span class="emptyField"></span>
                                </div>
                            </div>
                            <!--DATA NASCIMENTO-->
                            <div class="form-group col-10">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                    </div>
                                    <input class="form-control dados" placeholder="Data_Nascimento" type="date" name="data_nascimento">
                                </div>
                            </div>
                            <!--TELEFONE-->
                            <div class="form-group col-6">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="TELEFONE" type="text" name="telefone">
                                </div>
                            </div>
                            <!--Endereco-->
                            <div class="form-group col-12">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Endereco" type="text" name="endereco">
                                </div>
                            </div>
                            <!--Estados-->
                            <div class="form-group col-12">
                                <div style="text-align:center">Selecione seu estado</div>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="*">Selecione seu estado</option>
                                </select>
                            </div>
                            <!--Cidades-->
                            <div id="fieldCidades" style="display:none" class="form-group col-12">
                                <div style="text-align:center">Adicione sua cidade</div>
                                <select class="form-control" name="cidade" id="cidades">
                                    <option value="*">Selecione sua cidade</option>
                                </select>
                            </div>
                            <!--Roles-->

                            <div class="form-group col-12">
                                <div style="text-align:center">Adicione seus roles</div>
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Roles" type="text" name="role">
                                    <button type="button" class="btn btn-primary" id="btnSelect">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>

                            </div>

                            <!--select roles-->
                            <div id="selectRoles" style="display:none" class="form-group col-12">

                                <select class="form-control" name="rolesSelect[]" id="rolesSelect" multiple="multiple">
                                </select>
                            </div>


                            <x-panel />
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        //adicionar roles no select a partir do botão
        $('#btnSelect').click(function() {
            let roles = $('input[name=role]').val()
            $('#rolesSelect').append(`<option selected>${roles}</option>`)
            $('input[name=role]').val('');
            $('#selectRoles').show()
        })
        //buscar siglas de estados para popular o select
        $.ajax({
            type: 'GET',
            url: "{{route('backEstados')}}",
            success: function(data) {
                // $('#estado').html(data);
                for (i in data) {
                    $('#estado').append(`<option value=${data[i]['id']}|${data[i]['sigla']}>${data[i]['sigla']}</option>`)
                }
            },

        });
        //popular cidades dependendo do estado que estiver selecionado
        $('#estado').change(function() {

            let valorEstadoEscolhido = $(this).val()
            let url = '{{ route("backCidades", ":id") }}';
            url = url.replace(':id', valorEstadoEscolhido);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#cidades').html('')
                    for (i in data) {
                        $('#cidades').append(`<option value="${data[i]['cidade']}">${data[i]['cidade']}</option>`)
                    }
                },
            });
            $('#fieldCidades').show()
        })

    })
</script>