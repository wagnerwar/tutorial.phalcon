<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Noticias">
        <meta name="author" content="Time do Falcão">
    </head>
    <body>
      <!--
      Fazer menu de navegação
      -->
      <ul class="nav navbar-inverse">
        <li>{{ linkTo('noticias/index','Noticias') }}</li>
      </ul>
      <div class="container">
          {{ flash.output() }}
          {{ content() }}
          <hr>
          <footer>
              <p>Direitos reservados para Wawa</p>
          </footer>
      </div>

        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('js/bootstrap-datepicker.js') }}
        {{ javascript_include('js/bootstrap-datepicker.pt.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}
        {{ javascript_include('js/main.js') }}

    </body>
</html>
