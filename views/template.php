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
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Logo</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link btn btn-primary" href="#">Criar Conta</a>
					</li>
					<li class="nav-item " >
						<a class="nav-link btn btn-success" href="#" >Login</a>
					</li>
				</ul>
			</div>
		</nav>	
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	<script src="<?php echo BASE_URL.'assets/js/jquery.min.js' ?>"></script>
	<script src="<?php echo BASE_URL.'assets/js/bootstrap.bundle.min.js' ?>"></script>
	<script src="<?php echo BASE_URL.'assets/js/jquery.mask.js' ?>"></script>
	<script src="<?php echo BASE_URL.'assets/js/script.js' ?>"></script>
	</body> 
</html>