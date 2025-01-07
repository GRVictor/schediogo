<h1 class="page-name">Crear Cuenta</h1>
<p class="page-description">Ingresa los siguientes datos para crear tu cuenta</p>

<?php 
    include_once __DIR__ . '/../templates/alerts.php';
?>

<form class="form" action="/sign-up" method="POST">
    <div class="field">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" placeholder="John" value="<?php echo s($user->name) ?>" >
    </div>

    <div class="field">
        <label for="lastname">Apellido:</label>
        <input type="text" id="lastname" name="last_name" placeholder="Doe" value="<?php echo s($user->last_name) ?>" >
    </div>

    <div class="field">
        <label for="phone">Teléfono:</label>
        <input type="tel" id="phone" name="phone" placeholder="0123456789" value="<?php echo s($user->phone) ?>">
    </div>

    <div class="field">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com" value="<?php echo s($user->email) ?>">
    </div>

    <div class="field">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="********">
    </div>

    <input type="submit" class="btn btn-primary" value="Crear cuenta">
</form>

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/forgot">Olvide mi contraseña</a>
</div>