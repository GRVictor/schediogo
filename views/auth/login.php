<h1 class="page-name">Iniciar Sesión</h1>
<p class="page-description">Bienvenido, inicia sesión con tu datos</p>

<form class="form" method="POST" action="/" >
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="ejemplo@ejemplo.com" name="email" autocomplete="email">
    </div>

    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="********" name="password" autocomplete="current-password">
    </div>

    <input type="submit" class="btn btn-primary" value="Iniciar sesión">

</form>

<div class="actions">
    <a href="/sign-up">Crea una cuenta</a>
    <a href="/forgot">Olvide mi contraseña</a>
</div>