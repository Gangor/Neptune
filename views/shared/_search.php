<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-4">
            <form id="filter" name="filter" method="post">
                <div class="input-group">
                    <?php Form::Input( $models->Validations[ 'Search' ], $models->Search ) ?>
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-success" />
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'filter' ); ?>