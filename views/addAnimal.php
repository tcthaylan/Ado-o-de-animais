<div class="container">
    <h3>Cadastrar Animal</h3>
    <?php if (!empty($msg)): ?>
        <div class="alert"><?php echo $msg ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" cols="30" rows="10" class="form-control" required></textarea>
        </div>

        <!-- Espécie -->
        <div class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Espécie</legend>
                <div class="col-sm-10">
                    <?php foreach ($species as $specie): ?>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="radio" name="id_specie" value="<?php echo $specie['id_specie'] ?>" checked>
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
                        <input class="form-check-input" type="radio" name="size" id="pequeno" value="P" checked>
                        <label class="form-check-label" for="pequeno">
                            Pequeno
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="medio" value="M">
                        <label class="form-check-label" for="medio">
                            Médio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="grande" value="G">
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
                        <input class="form-check-input" type="radio" name="gender" id="macho" value="M" checked>
                        <label class="form-check-label" for="macho">
                            Macho
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femea" value="F">
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
                    <option value="<?php echo $state['uf'] ?>"><?php echo $state['state_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-8">
                <label for="city">Cidade</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
        </div>

        <input type="submit" value="Cadastrar">
    </form>
</div>