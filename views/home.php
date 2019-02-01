
<section class="banner">
    <div class="container">
        <header class="banner-text">
            <h1>Veniam consectetur</h1>
            <p class="lead">Sint labore do labore et. </p>
        </header>
        <a href="#" class="btn-banner">Explorar</a>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Animais Cadastrados</h2>
        </div>
    </div>
    <div class="row">
        <!-- Filtros -->
        <div class="col-12 col-lg-4">
            <form method="GET" class="">
                <div class="form-group">
                    <input type="text" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <select name="" id="" class="form-control">
                        <option value=""></option>
                        <?php foreach ($especialidades as $value): ?>
                            <option value="<?php echo $value[''] ?>"><?php echo $value['']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <input type="text" name="" id="" class="form-control" placeholder="">
                </div>
                <input type="submit" value="Filtrar" class="btn btn-primary">
            </form>
        </div>
        <!-- Lista de animais -->
        <div class="col-12 col-lg-8">
            <!-- Listagem de animais -->
            <ul class="row cards-animals">
                <?php foreach ($animals as $animal): ?>
                    <li class="col-4">
                        <?php if (!empty($animal['images'])): ?>
                        <img src="<?php echo BASE_URL.'assets/images/animalImages/'.$animal['images'][0]['url'] ?>" class="card-animal-img">
                        <?php else: ?>
                        <img src="<?php echo BASE_URL.'assets/images/default.jpg' ?>" class="card-animal-img">
                        <?php endif; ?>
                        <div class="card-animal-body">
                            <h3 class="name"><?php echo $animal['name'] ?></h3>
                            <p class="address"><?php echo $animal['city'] ?> - <?php echo $animal['uf'] ?></p>
                            <p><?php echo $animal['size'] ?></p>
                            <p><?php echo $animal['gender'] ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Paginação -->
            </ul>
            <?php for ($q = 1; $q <= $paginas; $q++): ?>
                <a href="<?php echo BASE_URL.'home?p='.$q; ?>"><?php echo $q ?></a>
            <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>