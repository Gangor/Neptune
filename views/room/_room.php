<?php
    $photos = $this->rooms->GetPhotos( $models->numero );
    $i = 0;
?>

<div class="col-md-4">
    <div class="card mb-4 box-shadow">

        <div id="carousel-<?php echo $models->numero ?>" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach( $photos as $photo ) { ?>
                    <div class="carousel-item <?php echo $i == 0 ? 'active' : '' ?>">
                        <img class="d-block w-100" height="232px" src="/assets/images/<?php echo $photo->photo ?>" alt="<?php echo $models->exposition ?>">
                    </div>
                <?php $i++; } ?>
                <a class="carousel-control-prev" href="#carousel-<?php echo $models->numero ?>" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel-<?php echo $models->numero ?>" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>

        <?php if ( $models->douche == 1 ) { ?>
            <div class="card-icon" title="Douche">
                <i class="fas fa-bath"></i>
            </div>
        <?php } ?>

        <div class="card-body">
            <p class="float-right"><?php echo $models->capacite ?> <i class="fas fa-male"></i></p>
            <p class="card-text">Chambre N° <?php echo $models->numero ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <?php if ( Session::Loggin() ) { ?>
                <div class="btn-group">
                    <?php if ( !$user->admin ) { ?>       
                        <a href="/room/reserve/<?php echo $models->numero ?>" class="btn btn-sm btn-primary">Reserver</a>
                    <?php } ?>
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