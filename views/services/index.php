<h1 class="page-name">Servicios</h1>
<p class="page-description">Administra tus servicios</p>

<?php 
    include_once __DIR__ . '/../templates/profile-bar.php';
?>

<ul class="services">
    <?php foreach ($services as $service) : ?>
        <li class="service">
            <p>Nombre:</p>
            <p><span><?php echo $service->service_name ?></span></p>
            <p>Precio:</p>
            <p><span>$<?php echo $service->price ?></span></p>

            <div class="actions">
                <a href="/services/update?id=<?php echo $service->id ?>" class="btn btn-edit">Editar</a>
                <form action="/services/delete" method="POST" class="delete-form">
                    <input type="hidden" name="id" value="<?php echo $service->id ?>">
                    <input type="submit" value="Eliminar" class="btn btn-delete">
                </form>
            </div>

        </li>
    <?php endforeach; ?>
</ul>

<?php
    $script = '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    $script .= '<script src="/build/js/deleteAlert.js"></script>';
?>