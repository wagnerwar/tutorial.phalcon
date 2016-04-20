<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }}
        {{ stylesheet_link('css/style.css') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Noticias">
        <meta name="author" content="Time do Falcão">
    </head>
    <body>
      <!--
      Fazer menu de navegação
      -->

      <div class="container-fluid black">
        <div class="nav-collapse">
      <ul class="nav navbar-inverse navbar-left">
        {% if session.has('logado') %}
        <li>{{ linkTo('noticias/index','Noticias') }}</li>
        {% endif %}
      </ul>
      </div>
      <div class="nav-collapse">
      <ul class="nav navbar-inverse navbar-right">
          {% if !session.has('logado') %}
          <li>{{ linkTo('session/index','login') }}</li>
          {% else %}
          <li>{{ linkTo('session/deslogar','logout') }}</li>
          {% endif %}
      </ul>
    </div>
    </div>
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
