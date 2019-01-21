<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Estoque</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/bootstrap.min.css' ?>">
		<link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/style.css' ?>">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="logo" href="<?php echo BASE_URL ?>">Logo</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<?php if ($viewData['menu'] == true): ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo BASE_URL.'user' ?>">Meus animais</a>
							</li>
							<li class="nav-item" >
								<a class="nav-link" href="<?php echo BASE_URL.'user/edit' ?>" >Editar Perfil</a>
							</li>
							<li class="nav-item" >
								<a class="nav-link" href="<?php echo BASE_URL.'login/sair' ?>" >Sair</a>
							</li>
						<?php elseif ($viewData['menu'] == false): ?>
							<li class="nav-item " >
								<a class="nav-link button button-register" href="<?php echo BASE_URL.'login/createAccount' ?>" >Criar Conta</a>
							</li>
							<li class="nav-item">
								<a class="nav-link button button-login" href="<?php echo BASE_URL.'login' ?>">Login</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>	
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	<script src="<?php echo BASE_URL.'assets/js/jquery.min.js' ?>"></script>
	<script src="<?php echo BASE_URL.'assets/js/bootstrap.bundle.min.js' ?>"></script>
	<script src="<?php echo BASE_URL.'assets/js/jquery.mask.js' ?>"></script>
	<script src="<?php echo BASE_URL.'assets/js/script.js' ?>"></script>
	</body> 
</html>