<h1 class="page-name">Recuperar Constraseña</h1>
<p class="page-description">Escribe tu nueva contraseña</p>

<?php
    include_once __DIR__ . '/../templates/alerts.php';
?>

<?php if($error) return; ?>
<form class="form" method="POST">
    <div class="field">
        <label for="password">Contraseña</label>
        <input class="form-input" type="password" name="password" id="password" placeholder="Tu nueva contraseña">
    </div>
    <input class="btn btn-primary" type="submit" value="Restablecer contraseña">
</form>

<div class="actions">
    <a href="/">Iniciar Sesión</a>
    <a href="/sign-up">Crear una cuenta</a>
</div>