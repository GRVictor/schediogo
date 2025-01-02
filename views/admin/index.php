<h1 class="page-name">Panel administrador</h1>

<?php 
    include_once __DIR__ . '/../templates/profile-bar.php'; 
?>

<h3>Buscar por fecha:</h3>
<div class="search">
    <form action="" class="form">
        <div class="field">
            <label for="date">Fecha</label>
            <input type="date" id="date" name="date">
        </div>
    </form>
</div>

<div id="appointments-admin">
    <h2>Citas del día</h2>
    <ul class="appointments">
        <?php
            $idAppointment = null; 
            foreach($appointments as $key => $appointment) {
                if($idAppointment !== $appointment->id) {  
                    $total = 0;  
                    if ($idAppointment !== null) {
                        // Close the last <li> if it's not the first iteration
                        echo '</li>';
                    }
                    $idAppointment = $appointment->id;
        ?>
        <li>
            <h3>Cita - ID #<?php echo $appointment->id ?></h3>
            <p>Hora: <span><?php echo date('H:i', strtotime($appointment->time)) ?></span></p>
            <p>Cliente: <span><?php echo $appointment->client?></span></p>
            <p>Teléfono: <span><?php echo $appointment->phone?></span></p>

            <h3>Servicios:</h3>
            
            <?php
                } // Closing bracket for if - $idAppointment !== $appointment->id
                $total += $appointment->price; 
            ?>
            <p class="service"><?php echo $appointment->service . " - $" . $appointment->price; ?></p>

            <?php
                $currentKey = $appointment->id;
                $next = $appointments[$key + 1]->id ?? null;

                if(itIsLast($currentKey, $next)) { ?>
                    <p class="total">Total: $<?php echo $total; ?></p>
            <?php
                } // Closing bracket for if - itIsLast
            } // Closing bracket for foreach - $appointments
            ?>
        </li> <!-- Cierra el último <li> -->
    </ul>
</div>