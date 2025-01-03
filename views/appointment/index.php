<h1 class="page-name">Crea una nueva cita</h1>
<p class="page-description">Sigue los pasos para crear una nueva cita</p>

<?php 
    include_once __DIR__ . '/../templates/profile-bar.php'; 
?>

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
                <label for="name">Tu nombre:</label>
                <input class="name-input" type="text" id="name" name="name" placeholder="Nombre" value="<?php echo $name; ?>" disabled autocomplete="off">
                <small>Este campo lo llenamos por ti. </small>
            </div>

            <div class="field">
                <label for="date">Selecciona la fecha</label>
                <input  type="date" id="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
            </div>

            <div class="field">
                <label for="time">Selecciona la hora</label>
                <input type="time" id="time">
            </div>
            <input type="hidden" id="client_id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="step-3" class="section resume-content">
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
    $script = "
    <link href='https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma@4/bulma.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='/build/js/app.js'></script>
    ";
?>