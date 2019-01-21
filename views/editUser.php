<h3>Editar</h3>
<?php if (!empty($msg)): ?>
    <div class="alert alert-success"><?php echo $msg ?></div>
<?php endif; ?>
<form method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control" required value="<?php echo $user['name'] ?>">
        </div>
        <div class="form-group col-md-6"">
            <label for="last_name">Sobrenome</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required value="<?php echo $user['last_name'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="password">Preencha a senha caso queira trocar</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="uf">Estado</label>
            <select id="uf" name="uf" class="form-control">
                <?php foreach ($states as $state): ?>
                <option value="<?php echo $state['uf'] ?> " <?php echo($state['uf'] == $user['uf'])?"selected='selected'":''; ?>><?php echo $state['state_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-8">
            <label for="city">Cidade</label>
            <input type="text" id="city" name="city" class="form-control" required value="<?php echo $user['city'] ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone">Telefone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $user['phone'] ?>">
        </div>
        <div class="form-group col-md-6"">
            <label for="cell_phone">Celular</label>
            <input type="text" id="cell_phone" name="cell_phone" class="form-control" value="<?php echo $user['cell_phone'] ?>">
        </div>
    </div>
    <input type="submit" value="Atualizar" class="btn btn-success">
</form>