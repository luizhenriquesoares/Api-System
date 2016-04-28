<!DOCTYPE html>
<html>
<head>
    <!-- Title -->
    <title>API | Elomilhas | Gerenciador</title>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8"/>
    <meta name="description" content="Gerenciador de API's | Elomilhas" />
    <meta name="keywords" content="manager,api,dashboard" />
    <meta name="author" content="Elomilhas" />

    {!! Form::hidden('BASE', url('/'), ['id' => 'BASE']) !!}

    <!-- Helpers in JS !-->
    @include($helper->base . 'partials.helpers.js')
    <!-- Inclusão do css !-->
    @include($helper->base . 'partials.assets-css')

    <!-- Inclusão de compatibilidade com IE !-->
    @include($helper->base . 'partials.hack')

</head>

<body class="page-header-fixed">

    <!-- Global token !-->
    {!! Form::token() !!}

    <!-- Inclusão de menu !-->
    @include($helper->base . 'partials.chatbar')

    <!-- Inclusão do modal perfil (clicar imagem usuario) !-->
    @include($helper->base . 'partials.profile')

    <main class="page-content content-wrap">
        <!-- Inclusão de menu !-->
        @include($helper->base . 'partials.navbar')

        <!-- Inclusão de sidebar !-->
        @include($helper->base . 'partials.sidebar')

        <div class="page-inner">

            <!-- Inclusão do breadcrumb !-->
            @include($helper->base . 'partials.breadcrumb')

            <div id="main-wrapper">
                <div class="row">

                    @section('content')
                    @show

                </div><!-- Row -->
            </div><!-- Main Wrapper -->

            <!-- Inclusão do footer !-->
            @include($helper->base . 'partials.footer')

        </div><!-- Page Inner -->
    </main><!-- Page Content -->

    <!-- Inclusão do javascript !-->
    @include($helper->base . 'partials.navbar-super')

    <!-- Inclusão do javascript !-->
    @include($helper->base . 'partials.assets-js')

    <!-- Inclusão de partial message !-->
    @include($helper->base . 'partials.message')

    <!-- Html Dinâmico Actions trashed!-->
    <div class="dynamic-html"></div>

    @if(isset($requireJS))
        @foreach($requireJS as $js)
        {!! Html::script(JS_PATH . $js) !!}
        @endforeach
    @endif

    <!-- Inclusão de errors de validação nos forms !-->
    @include($helper->base . 'partials.form-errors')

</body>
</html>
