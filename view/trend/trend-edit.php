<h1 class="page-header">
    <?php echo $noticia->id != null ? $noticia->title : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
    <li><a href="?c=Trend">Volver</a></li>
    <li class="active"><?php echo $noticia->id != null ? $noticia->title : 'Nuevo Registro'; ?></li>
</ol>

<form id="noticias-form" action="?c=Trend&a=Guardar" method="post">
    <input type="hidden" name="id" value="<?php echo $noticia->id; ?>" />

    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" id="title" name="title" value="<?php echo $noticia->title; ?>" class="form-control" placeholder="Introduce el título" required />
    </div>

    <div class="form-group">
        <label for="body">Resumen</label>
        <textarea name="body" id="body" class="form-control" required><?php echo $noticia->body; ?></textarea>
    </div>

    <div class="form-group">
        <label>Enlace</label>
        <input type="text" name="source" value="<?php echo $noticia->source; ?>" class="form-control" placeholder="Introduce el enlace a la noticia" pattern="(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})" required/>
    </div>

    <div class="form-group">
        <label>Vía</label>
        <input type="text" name="publisher" value="<?php echo $noticia->publisher; ?>" class="form-control" placeholder="Introduce el períodico de origen" required/>
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#noticias-form").submit(function(){
            return $(this).validate();
        });
    })
</script>