<div class="profile-bar">
    <p>Hola, <span><?php echo $name ?? ''; ?></span></p>
    <a href="/logout" class="btn-logout">Cerrar sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
        <div class="service-bar">
            <a href="/admin" class="btn">Ver Citas</a>
            <a href="/services" class="btn">Ver Servicios</a>
            <a href="/services/create" class="btn">Nuevo Servicio</a>
        </div>
<?php } ?>  