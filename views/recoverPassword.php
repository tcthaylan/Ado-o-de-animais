<h3>Recuperar Senha</h3>

<?php if (!empty($msg['success'])): ?>
    <div class="alert alert-success">
        <?php echo $msg['success'] ?>
        <a class="alert-link" href="<?php echo BASE_URL.'login'; ?>">acesse sua conta</a>
    </div>
<?php elseif (!empty($msg['danger'])): ?>
    <div class="alert alert-danger">
        <?php echo $msg['danger'] ?>
    </div>
<?php endif; ?>

<form method='POST'>
    Nova senha: <br>
    <input type="password" id="password"name="password"><br>
    <input type="submit" value="Alterar Senha">
</form>
