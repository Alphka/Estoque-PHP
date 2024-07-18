<!DOCTYPE html>
<html lang="pt=BR">
	<head>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container mt-5">
			<div class="text-center">
				<img class="mb-4 w-50" src="./imagens/php.png" alt="Logotipo">
				<h4>Controle de estoque</h4>
			</div>

			<form class="mt-4" action="autenticar.php" method="POST">
				<div class="form-group">
					<label>Usuário</label>
					<input type="text" name="usuario" class="form-control" placeholder="Digite o usuário" autocomplete="off" required>
				</div>

				<div class="form-group">
					<label>Senha</label>
					<input type="password" name="senha" class="form-control" placeholder="Senha" autocomplete="off" required>
				</div>

				<div class="form-group text-right">
					<button class="btn btn-sm btn-success" type="submit">Entrar</button>
				</div>
			</form>
		</div>

		<p class="text-center mt-4">Não possui cadastro? <a href="register.php">Registre-se</a>!</p>
	</body>
</html>
