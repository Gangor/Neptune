<?php
    $image = '';

    switch( $model->exposition )
    {
        case 'rempart': $image = '441ced068b51a0987fb9687dcd2095ca.jpg'; break;
        case 'port':    $image = '441ced068b51a0987fb9687dcd2095cb.jpg'; break;
    }
?>

<div class="col-md-4">
    <div class="card mb-4 box-shadow">
        <img class="card-img-top" alt="<?php echo $model->exposition ?>" style="height: 225px; width: 100%; display: block;" src="/assets/images/<?php echo $image ?>">
        <?php if ( $model->douche == 1 ) { ?>
            <div class="card-icon" title="Douche">
                <i class="fas fa-bath"></i>
            </div>
        <?php } ?>
        <div class="card-body">
            <p class="float-right"><?php echo $model->capacite ?> <i class="fas fa-male"></i></p>
            <p class="card-text"><a href="/room/view/<?php echo $model->numero ?>">Chambre N° <?php echo $model->numero ?></a></p>
            <div class="d-flex justify-content-between align-items-center">
                <?php if ( Session::Loggin() ) { ?>
                <div class="btn-group">
                    <a href="/room/reserve/<?php echo $model->numero ?>" class="btn btn-sm btn-primary">Reserver</a>
                    <?php if ( $user->admin ) { ?>                    
                        <a href="/room/edit/<?php echo $model->numero ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="/room/delete/<?php echo $model->numero ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    <?php } ?>
                </div>
                <?php } ?>
                <small class="text-muted align-right"><?php echo $model->prix ?> € / jour</small>
            </div>
        </div>
    </div>
</div>