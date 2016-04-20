{{ content() }}
<h1>Noticias para edicao</h1>
{{ link_to("noticias/cad", 'CADASTRAR NOTICIA', "class": "btn btn-default") }}

{% for noticia in page.items %}
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
            <td>{{ noticia.id }}</td>
            <td>{{ noticia.nome }}</td>
            <td>{{ noticia.descricao }}</td>
            <td>{{ noticia.getDataPublicacao()  }}</td>
            <td>{{ noticia.status  }}</td>
            <td width="7%">{{ link_to("noticias/editar/" ~ noticia.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("noticias/deleteNoticia/" ~ noticia.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
        {% if loop.last %}
        </tbody>
        <tbody>
            <tr>
                <td colspan="7" align="right">
                    <div class="btn-group">
                        {{ link_to("noticias/index", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                        {{ link_to("noticias/index?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                        {{ link_to("noticias/index?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                        {{ link_to("noticias/index?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                        <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
        {% endif %}
    {% else %}
        No news are recorded
    {% endfor %}
