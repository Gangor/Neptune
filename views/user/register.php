<?php
    $title = "Inscription";
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <h2 class="text-center"><?php echo $title ?></h2>
            <form>
                <div class="mb-5"></div>
                <h5 class="text-center">Information de connexion</h5>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" class="form-control" >
                </div>

                <div class="mb-3"></div>
                <h5 class="text-center">Information personnelle</h5>
                
                <div class="form-group">
                    <label for="civilite">Civilité</label>
                    <select id="civilite" class="form-control">
                        <option value="Monsieur">Monsieur</option>
                        <option value="Mademoiselle">Mademoiselle</option>
                        <option value="Madame">Madame</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input id="firstname" type="text" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input id="lastname" type="text" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input id="adresse" type="text" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="codepostal">Code postal</label>
                    <input id="codepostal" type="text" class="form-control" >
                </div>

                <button type="submit" class="btn btn-success">Confirmer</button>
            </form>
        </div>
    </div>
</div>

<div class="mb-5"></div>