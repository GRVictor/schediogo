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
        </li>
    <?php endforeach; ?>
</ul>