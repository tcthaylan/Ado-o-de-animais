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
    </div>
    <hr>
    <div class="animal-list">
        <h2>Animais Cadastrados</h2>
        <ul class="animal-list">
            <?php foreach ($animals as $animal): ?>
                <li class="animal-item">
                    <img src="<?php echo BASE_URL.'assets/images/default.jpg' ?>" alt="" class="animal-img">
                    <div class="animal-body">
                        <h5>Nome: <?php echo $animal['name'] ?></h5>
                        <h6>Endereço: Mauá - SP</h6>
                        <h6>Porte: <?php echo $animal['size'] ?></h6>
                    </div>
                    <div class="animal-buttons">
                        <a href="<?php echo BASE_URL.'animal/edit/'.$animal['id_animal'] ?>">Editar</a>
                        <a href="<?php echo BASE_URL.'animal/delete/'.$animal['id_animal'] ?>">Execluir</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php for ($q = 1; $q <= $paginas; $q++): ?>
            <a href="<?php echo BASE_URL.'user?p='.$q; ?>"><?php echo $q ?></a>
        <?php endfor; ?>
        </ul>
    </div>
</div>