<pre>
    <?php print_r($user); ?>
</pre>
<div class="container">
    <div class="user-data">
        <h2><?php echo $user['name'].' '.$user['last_name'] ?></h2>
        <h4>Email</h4>
        <p><?php echo $user['email'] ?></p>
        <h4>WhatsApp ou Telefone</h4>
        <p><?php echo $user['phone'].' | '.$user['cell_phone']  ?></p>
        <h4>Endereço</h4>
        <p><?php echo $user['city'].' - '.$user['uf'] ?></p>
    </div>
    <hr>
    <div class="buttons">
        <a href="<?php echo BASE_URL.'animal/add' ?>" class="btn btn-warning">Cadastrar novo animal</a>
        <a href="<?php echo BASE_URL.'animal/adoption' ?>" class="btn btn-warning">Marcar animais adotados</a>
    </div>
    <hr>
    <div class="animal-list">
        <h2>Animais Cadastrados</h2>
    </div>
</div>