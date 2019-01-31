<div class="container">
    <h3>Editar Animal</h3>
    <?php if (!empty($msg['success'])): ?>
        <div class="alert alert-success"><?php echo $msg['success'] ?></div>
    <?php elseif (!empty($msg['warning'])): ?>
        <div class="alert alert-warning"><?php echo $msg['warning'] ?></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control" required value="<?php echo $animal['name'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" cols="30" rows="10" class="form-control" required><?php echo $animal['description'] ?></textarea>
        </div>

        <!-- Espécie -->
        <div class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Espécie</legend>
                <div class="col-sm-10">
                    <?php foreach ($species as $specie): ?>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="radio" name="id_specie" value="<?php echo $specie['id_specie'] ?>" <?php echo($specie['id_specie'] == $animal['id_specie'])?'checked':''; ?>>
                            <label class="form-check-label" for="specie1">
                                <?php echo $specie['specie_name'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Tamanho -->
        <div class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Tamanho</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="pequeno" value="P" <?php echo($animal['size'] == 'P')?'checked':''; ?>>
                        <label class="form-check-label" for="pequeno">
                            Pequeno
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="medio" value="M" <?php echo($animal['size'] == 'M')?'checked':''; ?>>
                        <label class="form-check-label" for="medio">
                            Médio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="grande" value="G" <?php echo($animal['size'] == 'G')?'checked':''; ?>>
                        <label class="form-check-label" for="grande">
                            Grande
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sexo -->
        <div class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="macho" value="M" <?php echo($animal['gender'] == 'M')?'checked':''; ?>>
                        <label class="form-check-label" for="macho">
                            Macho
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femea" value="F" <?php echo($animal['gender'] == 'F')?'checked':''; ?>>
                        <label class="form-check-label" for="femea">
                            Fêmea
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Estado/Cidade -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="uf">Estado</label>
                <select id="uf" name="uf" class="form-control">
                    <?php foreach ($states as $state): ?>
                    <option value="<?php echo $state['uf'] ?>" <?php echo($state['uf'] == $animalAddress['uf'])?'selected="selected"':''; ?> ><?php echo $state['state_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-8">
                <label for="city">Cidade</label>
                <input type="text" id="city" name="city" class="form-control" required value="<?php echo $animalAddress['city'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="Fotos">Adicionar Fotos</label>
            <input type="file" id="fotos" name="fotos[]" multiple>
        </div>

        <div class="card">
            <div class="card-header">
                Fotos do animal
            </div>
            <div class="card-body">
                <?php foreach ($animalImages as $image): ?>
                    <img src="<?php echo BASE_URL.'assets/images/animalImages/'.$image['url']?>" class="img-thumbnail">
                    <a href="<?php echo BASE_URL.'animal/deleteAnimalImage/'.$image['id_animal'].'/'.$image['id_animal_image'] ?>" class="btn btn-outline-danger">Excluir</a>
                <?php endforeach; ?>
            </div>
        </div>

        <input type="submit" value="Atualizar">
    </form>
</div>