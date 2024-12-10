<h1 class="page-name">Recuperar mi contraseña</h1>
<p class="page-description">Te enviaremos un email para que cambies tu contraseña</p>

<form class="form" action="/forgot" method="POST" >

    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com"> 
    </div>

    <input type="submit" class="btn btn-primary" value="Enviar">

</form>

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/sign-up">Crear una cuenta</a>
</div>