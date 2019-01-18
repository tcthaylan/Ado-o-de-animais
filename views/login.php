<h3>Login</h3>

<form method="POST">
    Email: <br>
    <input type="text" id="email" name="email" required> <br>
    Senha: <br>
    <input type="password" id="password" name="password" required> <br>

    <a href="<?php echo BASE_URL . 'login/forgotPassword' ?>">Esqueci minha senha.</a><br>

    <input type="submit" value="Entrar">
</form>

<?php if (!empty($msg)): ?>
    <p><?php echo $msg ?></p>
<?php endif; ?>