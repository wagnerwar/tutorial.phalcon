
<fieldset>
{{ form("noticias/updateNoticia", 'role': 'form') }}
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
    {{ submit_button("Save", "class": "btn btn-success") }}
</form>
</fieldset>
