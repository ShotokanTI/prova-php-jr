<style>
    .espacamento {
        padding-left: 2vw;
        padding-top: 0.7vw;
    }


</style>
<nav class="navbar navbar-dark bg-dark" style="background-color:#111!important">

    <a style="color:#fff" target="_blank" href="https://github.com/ShotokanTI/prova-php-jr">
        <i style="font-size:37px" class="fab fa-github"></i>
    </a>
    <div style="display:flex">
        <div class="espacamento">
            <span style="color:#fff">{{ __('CRUD') }}</span>
        </div>
        <a target="_blank" href="https://comprezipp.com/">
            <img src="https://comprezipp.com/assets/images/logo.png" width="60px" height="40px">
        </a>
        <div class="espacamento">
            <a style="color: #fff;" href="{{ route('roles') }}">
                <span>EDITAR ROLES</span>
            </a>
        </div>
        <div class="espacamento">
            <a href="{{ route('/') }}">
                <span style="color:#fff;">{{ __('ADICIONAR USUARIO') }}</span>
            </a>
        </div>
      
</nav>