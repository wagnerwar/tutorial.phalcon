


<div class="row">
{% if noticias.length > 0  %}
{% for noticia in noticias %}
<div class="col-md-4">
  <h1>{{ noticia['nome'] }}</h1>
  <p>{{ noticia['descricao'] }}</p>
</div>
{% endfor %}
{% else %}
<h2>Nenhuma noticia encontrada</h2>
{% endif %}
</div>
