<?php
    $image = '';

    switch( $models->exposition )
    {
        case 'rempart': $image = '441ced068b51a0987fb9687dcd2095ca.jpg'; break;
        case 'port':    $image = '441ced068b51a0987fb9687dcd2095cb.jpg'; break;
    }
?>

<div class="col-md-4">
    <div class="card mb-4 box-shadow">
        <img class="card-img-top" alt="<?php echo $models->exposition ?>" style="height: 225px; width: 100%; display: block;" src="/assets/images/<?php echo $image ?>">
        <?php if ( $models->douche == 1 ) { ?>
            <div class="card-icon" title="Douche">
                <i class="fas fa-bath"></i>
            </div>
        <?php } ?>
        <div class="card-body">
            <p class="float-right"><?php echo $models->capacite ?> <i class="fas fa-male"></i></p>
            <p class="card-text"><a href="/room/view/<?php echo $models->numero ?>">Chambre N° <?php echo $models->numero ?></a></p>
            <div class="d-flex justify-content-between align-items-center">
                <?php if ( Session::Loggin() ) { ?>
                <div class="btn-group">
                    <a href="/room/reserve/<?php echo $models->numero ?>" class="btn btn-sm btn-primary">Reserver</a>
                    <?php if ( $user->admin ) { ?>                    
                        <a href="/room/edit/<?php echo $models->numero ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="/room/delete/<?php echo $models->numero ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    <?php } ?>
                </div>
                <?php } ?>
                <small class="text-muted align-right"><?php echo $models->prix ?> € / jour</small>
            </div>
        </div>
    </div>
</div>