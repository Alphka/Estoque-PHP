<?php

session_start();

$usuario = $_SESSION["usuario"];

if(!isset($usuario)){
	header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Página inicial</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container mt-5">
			<ul class="row list-unstyled">
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM208-800h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Z" />
								</svg>
								<span class="pl-2">Adicionar produto</span>
							</h5>
							<p class="card-text">Adicione novos produtos em seu estoque.</p>
							<a href="adicionar_produto.php" class="btn btn-sm btn-primary">Cadastrar produto</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z" />
								</svg>
								<span class="pl-2">Lista de produtos</span>
							</h5>
							<p class="card-text">Edite, liste e adicione exclua seus produtos.</p>
							<a href="listar_produto.php" class="btn btn-sm btn-primary">Listar produtos</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
								<path d="m260-520 220-360 220 360H260ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-20v-320h320v320H120Z" />
								</svg>
								<span class="pl-2">Adicionar categorias</span>
							</h5>
							<p class="card-text">Adicione novas categorias para seus produtos.</p>
							<a href="adicionar_categoria.php" class="btn btn-sm btn-primary">Adicionar categoria</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M80-140v-320h320v320H80Zm140-420 220-360 220 360H220ZM863-42 757-148q-21 14-45.5 21t-51.5 7q-75 0-127.5-52.5T480-300q0-75 52.5-127.5T660-480q75 0 127.5 52.5T840-300q0 26-7 50.5T813-204L919-98l-56 56ZM660-200q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Z" />
								</svg>
								<span class="pl-2">Listar categorias</span>
							</h5>
							<p class="card-text">Edite, liste e adicione exclua suas categorias cadastradas.</p>
							<a href="listar_categoria.php" class="btn btn-sm btn-primary">Listar categorias</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Z" />
								</svg>
								<span class="pl-2">Adicionar Fornecedores</span>
							</h5>
							<p class="card-text">Adicione novos fornecedores de seus produtos.</p>
							<a href="adicionar_fornecedor.php" class="btn btn-sm btn-primary">Adicionar fornecedor</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Z" />
								</svg>
								<span class="pl-2">Listar fornecedores</span>
							</h5>
							<p class="card-text">Edite, liste e adicione exclua seus fornecedores já cadastrados.</p>
							<a href="listar_fornecedor.php" class="btn btn-sm btn-primary">Listar fornecedores</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M80-140v-320h320v320H80Zm140-420 220-360 220 360H220ZM863-42 757-148q-21 14-45.5 21t-51.5 7q-75 0-127.5-52.5T480-300q0-75 52.5-127.5T660-480q75 0 127.5 52.5T840-300q0 26-7 50.5T813-204L919-98l-56 56ZM660-200q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Z" />
								</svg>
								<span class="pl-2">Cadastrar usuários</span>
							</h5>
							<p class="card-text">Cadastre novos usuários no sistema.</p>
							<a href="adicionar_fornecedor.php" class="btn btn-sm btn-primary">Cadastrar novo</a>
						</div>
					</div>
				</li>
				<li class="col-sm-6 mt-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title d-flex align-items-center">
								<svg class="flex-shrink-0" style="height: 1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
									<path d="M622-144 484-282l56-56 82 82 202-202 56 56-258 258ZM400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm114 52L368-282l122 122H80v-112q0-33 17-62t47-44q51-26 115-44t141-18q30 0 58.5 3t55.5 9Z" />
								</svg>
								<span class="pl-2">Aprovar usuários</span>
							</h5>
							<p class="card-text">Aprove os usuários que se cadastraram no sistema por meio externo.</p>
							<a href="listar_fornecedor.php" class="btn btn-sm btn-primary">Exibir lista</a>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<script src="https://kit.fontawesome.com/cae6919cdb.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</body>
</html>
