<h3>Criar Conta</h3>

<?php if (!empty($msg['success'])): ?>
    <div class="alert alert-success">
        <?php echo $msg['success'] ?>
        <a class="alert-link" href="<?php echo BASE_URL.'login'?>">login.</a>
    </div>
<?php elseif (!empty($msg['warning'])): ?>
    <div class="alert alert-warning">
        <?php echo $msg['warning'] ?>
    </div>
<?php elseif (!empty($msg['danger'])): ?>
    <div class="alert alert-danger">
        <?php echo $msg['danger'] ?>
    </div>
<?php endif; ?>

<form method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group col-md-6"">
            <label for="last_name">Sobrenome</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
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
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone">Telefone</label>
            <input type="text" id="phone" name="phone" class="form-control">
        </div>
        <div class="form-group col-md-6"">
            <label for="cell_phone">Celular</label>
            <input type="text" id="cell_phone" name="cell_phone" class="form-control">
        </div>
    </div>
    <input type="submit" value="Cadastrar" class="btn btn-primary">
</form>