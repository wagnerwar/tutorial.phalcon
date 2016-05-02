{{ content() }}

<h1>Edicao de noticias</h1>
<fieldset>
{{ form("teste/editando") }}
<div class="form-group">
              
<input id="id" name="id" value="{{ noticia.id }}" type="hidden">
<label for="nome">Titulo</label>             
<input id="nome" name="nome" class="form-control" type="text" value="{{ noticia.nome }}">         
</div>
<div class="form-group">
             
<label for="descricao">Descricao</label>             
<textarea id="descricao" name="descricao" class="form-control">{{ noticia.descricao }}</textarea>         
</div>   

<div class="form-group">
                
<label for="status">Status</label>                
<select id="status" name="status" class="form-control">
	<option {% if noticia.status == 'PUBLICADO'  %}selected="selected"{% endif %} value="PUBLICADO">Publicar</option>
	<option {% if noticia.status == 'PRIVADO'  %}selected="selected"{% endif %} value="PRIVADO">Privado</option>
</select>            
</div>
           
{{ submit_button("Salvar", "class": "btn btn-success") }}
{{ end_form() }}
