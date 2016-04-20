


<div class="row">
{% for noticia in noticias %}
<div class="col-md-4">
  <h1>{{ noticia['nome'] }}</h1>
  <p>{{ noticia['descricao'] }}</p>
</div>
{% endfor %}
</div>
