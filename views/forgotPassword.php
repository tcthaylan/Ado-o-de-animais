<h3>Esqueci a minha senha</h3>
<?php if (!empty($msg['success'])): ?>
    <div class="alert alert-success">
        <?php echo $msg['success'] ?>
    </div>
<?php elseif (!empty($msg['warning'])): ?>
    <div class="alert alert-warning">
        <?php echo $msg['warning'] ?>
    </div>
<?php endif; ?>
<form method="POST">
    Email: <br>
    <input type="email" id="email" name="email" required><br><br>
    <input type="submit" value="Recuperar senha">
</form>