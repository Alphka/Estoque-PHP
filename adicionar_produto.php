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
		<meta name="color-scheme" content="dark">
		<title>Cadastrar produto - Estoque</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<style>
			:root {
				color-scheme: dark;
			}
		</style>
	</head>
	<body class="bg-gray-700 text-gray-50 min-h-dvh">
		<main>
			<header class="pt-8">
				<hgroup class="flex flex-col text-center gap-2">
					<h1 class="text-3xl font-bold leading-none">Formulário de cadastro</h1>
					<h2 class="text-xl font-semibold leading-normal">Cadastrar produto</h2>
				</hgroup>
			</header>

			<form class="container flex flex-col pt-8 px-4 gap-4" action="inserir_produto.php" method="post">
				<div class="w-full">
					<div class="relative w-full h-10">
						<input name="nome" class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-[7px] border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						" placeholder="">
						<label class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-blue-gray-200 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						">
							Nome do produto
						</label>
					</div>
				</div>

				<div class="w-full">
					<div class="relative w-full h-10">
						<input name="numero" class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-[7px] border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						" placeholder="">
						<label class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-blue-gray-200 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						">
							Número do produto
						</label>
					</div>
				</div>

				<div class="relative w-full h-12">
					<select class="
						peer h-full w-full rounded-md
						border border-slate-400 border-t-transparent bg-transparent px-3 py-2.5
						text-gray-200 text-sm font-normal outline outline-0
						placeholder-shown:border placeholder-shown:border-blue-gray-200
						placeholder-shown:border-t-slate-400
						focus:border-slate-200 focus:border-2 focus:border-t-transparent focus:outline-0
						transition-all
					" required>
						<option value="" hidden disabled selected>Selecione uma categoria</option>
						<?php
							include "conexao.php";

							$query = mysqli_query($connection, "SELECT * FROM categoria");

							if(mysqli_num_rows($query)){
								foreach($query as $row){
									$id = $row["id_categoria"];
									$categoria = $row["categoria"];
									echo "<option class=\"bg-gray-800\" value=\"$id\">$categoria</option>";
								}
							}
						?>
					</select>
					<label class="
						text-slate-200
						before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-xs font-normal leading-tight
						before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l
						before:border-slate-400 before:transition-all
						after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r
						after:border-slate-400 after:transition-all peer-placeholder-shown:text-sm
						peer-placeholder-shown:leading-[3.75]
						peer-placeholder-shown:text-slate-200 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent
						peer-focus:text-xs peer-focus:leading-tight peer-focus:text-slate-200 peer-focus:before:border-t-2 peer-focus:before:border-l-2
						peer-focus:before:border-slate-200 peer-focus:after:border-t-2 peer-focus:after:border-r-2
						peer-focus:after:border-slate-200 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent
						peer-disabled:peer-placeholder-shown:text-slate-200
						transition-all
					">
						Categoria
					</label>
				</div>

				<div class="w-full">
					<div class="relative w-full h-10">
						<input name="numero" class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-[7px] border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						" placeholder="">
						<label class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-blue-gray-200 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						">
							Número do produto
						</label>
					</div>
				</div>

				<div class="flex flex-col gap-1">
					<label>Categoria</label>
					<select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="categoria">

					</select>
				</div>
				<div class="flex flex-col gap-1">
					<label>Quantidade</label>
					<input type="number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="quantidade" placeholder="Insira a quantidade disponível">
				</div>
				<div class="flex flex-col gap-1">
					<label>Fornecedor</label>
					<select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="fornecedor">

					</select>
				</div>

				<div style="text-align: right;">
					<a href="menu.php" role="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-blue-600 text-white hover:bg-blue-600 py-1 px-2 leading-tight text-xs ">Voltar ao menu</a>
					<button type="submit" id="botao" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-green-500 text-white hover:green-600 py-1 px-2 leading-tight text-xs ">Cadastrar</button>
				</div>
			</form>
		</main>
	</body>
</html>
