{{ content() }}

<h1>Criaçãode noticias</h1>
<fieldset>
{{ form("teste/cadastro") }}
<div class="form-group">
              

<label for="nome">Titulo</label>             
<input id="nome" name="nome" class="form-control" type="text">         
</div>
<div class="form-group">
<div class="form-group">
             
<label for="descricao">Descricao</label>             
<textarea id="descricao" name="descricao" class="form-control"></textarea>         
</div>              
{{ submit_button("Salvar", "class": "btn btn-success") }}
{{ end_form() }}
