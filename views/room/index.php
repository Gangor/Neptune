<?php
    $title = "Chambres";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row">
        <?php 
            foreach( $rooms as $room )
            {
                $this->view[ 'room' ] = $room;
                $this->renderPartial( VIEWS. '/room/_room.php' );
            }
        ?>
    </div>
</div>
<div class="mt-5"></div>