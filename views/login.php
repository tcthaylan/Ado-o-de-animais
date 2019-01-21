<div class="form-login">
    <div class="form-header">
        <h3>Login</h3>
    </div>
    <div class="form-body">
        <form method="POST">
            <input type="text" id="email" name="email" placeholder="Email..." required> <br>
            <input type="password" id="password" name="password" placeholder="Senha..." required> <br>
            <a href="<?php echo BASE_URL . 'login/forgotPassword' ?>" class="forgot-link">Esqueceu a senha?</a><br>
            <input type="submit" value="Entrar" class="button-submit-login">
        </form>
    </div>
    <div class="form-footer">
        <?php if (!empty($msg)): ?>
            <p><?php echo $msg ?></p>
        <?php endif; ?>
    </div>
</div>
