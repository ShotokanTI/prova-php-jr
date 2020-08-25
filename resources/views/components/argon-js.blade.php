<!-- Core -->
<script src="./argon/vendor/jquery/dist/jquery.min.js"></script>
<script src="./argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="./argon/js/argon.min.js"></script>



<script>
    //adicionar roles no select a partir do botão
    $('#btnSelect').click(function() {
        let roles = $('input[name=role]').val()
        $('#rolesSelect').append(`<option selected>${roles}</option>`)
        $('input[name=role]').val('');
        $('#selectRoles').show()
    })
</script>