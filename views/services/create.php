<h1 class="page-name">Crear Nuevo Servicio</h1>
<p class="page-description">Crea un nuevo servicio</p>

<?php 
    include_once __DIR__ . '/../templates/profile-bar.php';
    include_once __DIR__ . '/../templates/alerts.php';
?>

<form action="/services/create" method="POST" class="form">
    <?php include_once __DIR__ . '/form.php'; ?>

    <input type="submit" class="btn" value="Crear Servicio">
</form>