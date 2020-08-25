<div class="modal" id="modalRole" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('addRole')}}">
                    @csrf
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" name="cpf" class="form-control" required>
                    </div>
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

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar roles</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>