<h1 class="page-header">List</h1>

<div class="text-right">
    <a class="btn btn-primary" href="?c=Trend&a=Crud">New trend</a>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Título</th>
        <th>Resumen</th>
        <th>Enlace</th>
        <th>Vía</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $t): ?>
        <tr>
            <td><?php echo $t->title; ?></td>
            <td><?php echo implode(' ', array_slice(explode(' ', $t->body), 0, 14)) . "..." ?></td>
            <td><a href="'<?php echo $t->source; ?>'" target="_blank">Ir a la noticia</a></td>
            <td><?php echo $t->publisher; ?></td>
            <td>
                <a class="btn btn-info" href="?c=Trend&a=Crud&id=<?php echo $t->id; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de eliminar esta noticia?');" href="?c=Trend&a=Eliminar&id=<?php echo $t->id; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
