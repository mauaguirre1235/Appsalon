<?php
foreach ($alertas as $key => $mensajes):
    foreach ($mensajes as $mensajes):
        ?>
        <div class="alerta <?php echo $key; ?>">
            <?php echo $mensajes; ?>
        </div>
        <?php
    endforeach;
endforeach;
?>