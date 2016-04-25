{{ content() }}

<h1>Criaçãode noticias</h1>
<fieldset>
{{ form("noticias/cad") }}
{% for element in form %}
     {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
         {{ element }}
     {% else %}
         <div class="form-group">
             {{ element.label() }}
             {{ element.render(['class': 'form-control']) }}
         </div>
     {% endif %}
 {% endfor %}
 {{ submit_button("Salvar", "class": "btn btn-success") }}
{{ end_form() }}

</fieldset>
