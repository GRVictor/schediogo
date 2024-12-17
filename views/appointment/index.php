<h1 class="page-name">Crea una nueva cita</h1>
<p class="page-description">Sigue los pasos para crear una nueva cita</p>

<div class="app">

    <nav class="tabs">
        <button class="current" type="btn" data-step="1">Servicios</button>
        <button type="btn" data-step="2">Información de la cita</button>
        <button type="btn" data-step="3">Resumen</button>
    </nav>

    <div id="step-1" class="section">
        <h2>Servicios</h2>
        <p>Selecciona un servicio de la lista a continuación para continuar con la creación de tu cita.</p>
        <div id="service" class="service-list"></div>
    </div>
    <div id="step-2" class="section">
        <h2>Datos de la cita</h2>
        <p>Coloca tus datos y la fecha de tú cita</p>
        <form class="form">
            <div class="field">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Nombre" value="<?php echo $name; ?>" disabled>
            </div>

            <div class="field">
                <label for="date">Email</label>
                <input type="date" id="date">
            </div>

            <div class="field">
                <label for="time">Hora</label>
                <input type="time" id="time">
            </div>
        </form>
    </div>
    <div id="step-3" class="section">
        <h2>Resumen</h2>
        <p>Confirma los datos de tu cita</p>
    </div>

    <div class="pagination">
        <button id="prev" class="btn" type="button">&laquo; Anterior</button>
        <div class="space"> aa</div>
        <button id="next" class="btn" type="button">Siguiente &raquo;</button>
    </div>
</div>

<?php 
    $script = "<script src='/build/js/app.js'></script>";
?>