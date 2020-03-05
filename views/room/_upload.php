<div class="row">
    <?php foreach( $photos as $photo ) { ?>
        <div class="col-md-4">
            <img src="/assets/images/<?php echo $photo->photo ?>" width="190" />
            <div class="mt-1"></div>
            <a href="/room/deletePhoto/<?php echo $photo->num ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
        </div>

    <?php } ?>
</div>

<hr>

<h5>Ajouter une photo</h5>
<form id="upload" name="upload" enctype="multipart/form-data" action="/room/upload/<?php echo $room->numero ?>" method="post">
    <div class="text-danger"><?php if ( isset( $error2 ) ) echo $error2; ?></div>
    <div class="form-group">
        <?php Form::Input( $models->Validations[ 'Photo' ], null ) ?>
        <?php Form::Label( $models->Validations[ 'Photo' ] ) ?>
    </div>
    
    <div class="form-group">
        <input type="submit" value="Envoyer" class="btn btn-success" />
    </div>
</form>