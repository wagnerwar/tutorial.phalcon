{{ content() }}
<h1>Noticias para edicao</h1>
{{ link_to("teste/cadastro", 'CADASTRAR NOTICIA', "class": "btn btn-default") }}

{% for noticia in dados %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Descricao</th>
            <th>Data de publicacao</th>
            <th>Status</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ noticia['id'] }}</td>
            <td>{{ noticia['nome'] }} </td>
            <td>{{ noticia['descricao'] }} </td>
            <td>{{ noticia['data_publicacao']  }}</td>
            <td>{{ noticia['status']  }}</td>
            <td width="7%">{{ link_to("teste/editar/" ~ noticia['id'], '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("teste/delete/" ~ noticia['id'], '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
        {% if loop.last %}
        </tbody>
    </table>
        {% endif %}
    {% else %}
        No news are recorded
    {% endfor %}
