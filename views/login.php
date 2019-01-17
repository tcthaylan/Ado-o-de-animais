<h3>Login</h3>

<form method="POST">
    Email: <br>
    <input type="text" id="email" name="email"> <br><br>
    Senha: <br>
    <input type="password" id="password" name="password"> <br><br>

    <input type="submit" value="Entrar">
</form>

<?php if (!empty($msg)): ?>
    <p><?php echo $msg ?></p>
<?php endif; ?>