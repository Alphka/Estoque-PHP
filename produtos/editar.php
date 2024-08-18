<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../login.html");

$queries = [];
parse_str($_SERVER["QUERY_STRING"], $queries);

$id = isset($queries["id"]) ? $queries["id"] : null;

try{
	if(!$id || empty($id = trim($id))) throw new Exception("ID is not defined");
	$id = intval($id);
}catch(Exception $error){
	header("Location: ../../produtos/listar.php", true, 301);
	return;
}

include "../conexao.php";

$produtos = mysqli_query($connection, "SELECT id, nome, numero, categoria, quantidade, fornecedor FROM estoque WHERE id = $id LIMIT 1");

if(mysqli_num_rows($produtos) === 0){
	http_response_code(404);
	return;
}

$categorias = mysqli_query($connection, "SELECT nome FROM categoria ORDER BY nome ASC");
$fornecedores = mysqli_query($connection, "SELECT nome FROM fornecedor ORDER BY nome ASC");
$produto = mysqli_fetch_array($produtos);

mysqli_close($connection);

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="color-scheme" content="dark">
		<title>Editar produto - Estoque</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link rel="stylesheet" href="../styles/global.css">
	</head>
	<body class="bg-gray-700 text-gray-50 min-h-dvh">
		<main>
			<header class="pt-8">
				<hgroup class="flex flex-col text-center gap-2">
					<h1 class="text-3xl font-bold leading-none">Formulário de edição</h1>
					<h2 class="text-xl font-semibold leading-normal">Editar informações do produto</h2>
				</hgroup>
			</header>

			<form
				class="container max-w-md flex flex-col pt-8 px-4 mx-auto gap-4"
				autocomplete="off"
				action="../api/produtos/editar.php?id=<?php echo $produto["id"] ?>"
				method="post"
			>
				<div class="relative h-10">
					<input
						type="number"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							disabled:border-0 disabled:bg-gray-400 disabled:bg-opacity-10 disabled:select-none
							transition-all
						"
						placeholder
						value="<?php echo $produto["id"] ?>"
						disabled
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-200 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-slate-400 after:border-slate-400 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							peer-disabled:text-gray-200 peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:red-500
							transition-all before:transition-all after:transition-all
						"
						for="nome"
						aria-hidden="true"
					>
						ID do produto
					</label>
				</div>

				<div class="relative h-10">
					<input
						id="nome"
						name="nome"
						type="text"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						"
						placeholder
						value="<?php echo $produto["nome"] ?>"
						required
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-200 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-slate-400 after:border-slate-400 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						"
						for="nome"
						aria-hidden="true"
					>
						Nome do produto
					</label>
				</div>

				<div class="relative h-10">
					<input
						id="numero"
						name="numero"
						type="number"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						"
						min="1"
						step="1"
						value="<?php echo $produto["numero"] ?>"
						placeholder
						required
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-200 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-slate-400 after:border-slate-400 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						"
						for="numero"
						aria-hidden="true"
					>
						Número do produto
					</label>
				</div>

				<div class="relative h-12">
					<select
						id="categoria"
						name="categoria"
						class="
							peer h-full w-full rounded-md
							border border-slate-400 border-t-transparent bg-transparent px-3 py-2.5
							text-slate-200 invalid:text-slate-400 text-sm font-normal outline outline-0
							placeholder-shown:border placeholder-shown:border-blue-gray-200
							placeholder-shown:border-t-slate-400
							focus:border-slate-200 focus:border-2 focus:border-t-transparent focus:outline-0
							cursor-pointer transition-all
						"
						required
					>
						<option value hidden disabled>Selecione uma categoria</option>
						<?php
							if(mysqli_num_rows($categorias)){
								foreach($categorias as $categoria){
									$nome = $categoria["nome"];
						?>
									<option
										class="bg-gray-800"
										value="<?php echo $nome ?>"
										<?php if($nome === $produto["categoria"]) echo "selected" ?>
									>
										<?php echo $nome ?>
									</option>
						<?php
								}
							}
						?>
					</select>
					<label
						class="
							text-slate-400
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
						"
						for="categoria"
						aria-hidden="true"
					>
						Categoria
					</label>
				</div>

				<div class="relative h-10">
					<input
						id="quantidade"
						name="quantidade"
						type="number"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						"
						min="1"
						step="1"
						value="<?php echo $produto["quantidade"] ?>"
						placeholder
						required
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-200 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-slate-400 after:border-slate-400 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						"
						for="quantidade"
						aria-hidden="true"
					>
						Insira a quantidade disponível
					</label>
				</div>

				<div class="relative h-12">
					<select
						id="fornecedor"
						name="fornecedor"
						class="
							peer h-full w-full rounded-md
							border border-slate-400 border-t-transparent bg-transparent px-3 py-2.5
							text-slate-200 invalid:text-slate-400 text-sm font-normal outline outline-0
							placeholder-shown:border placeholder-shown:border-blue-gray-200
							placeholder-shown:border-t-slate-400
							focus:border-slate-200 focus:border-2 focus:border-t-transparent focus:outline-0
							cursor-pointer transition-all
						"
						required
					>
						<option value hidden disabled>Selecione um fornecedor</option>
						<?php
							if(mysqli_num_rows($fornecedores)){
								foreach($fornecedores as $fornecedor){
									$nome = $fornecedor["nome"];
									?>
									<option
										class="bg-gray-800"
										value="<?php echo $nome ?>"
										<?php if($nome === $produto["fornecedor"]) echo "selected" ?>
									>
										<?php echo $nome ?>
									</option>
									<?php
								}
							}
						?>
					</select>
					<label
						class="
							text-slate-400
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
						"
						for="fornecedor"
						aria-hidden="true"
					>
						Fornecedor
					</label>
				</div>

				<button
					class="bg-blue-500 focus:bg-blue-600 enabled:hover:bg-blue-600 enabled:hover:shadow disabled:bg-blue-700 disabled:cursor-not-allowed flex items-center text-center px-3 py-1 w-fit mx-auto rounded select-none"
					aria-label="Clique para enviar o formulário"
					type="submit"
				>
					Enviar
				</button>
			</form>

			<div class="fixed top-5 right-5 flex flex-col w-full max-w-xs select-none gap-4">
				<div id="toast-success" class="invisible bg-gray-800 text-gray-200 flex items-center p-4 rounded-lg shadow transition-transform" role="alert" aria-hidden="true">
					<div class="bg-green-800 text-green-200 inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg" aria-hidden="true">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
							<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"></path>
						</svg>
					</div>
					<div class="message ms-3 text-sm"></div>
					<button
						class="bg-gray-800 inline-flex items-center justify-center text-gray-500 hover:bg-gray-700 hover:text-white focus-within:bg-gray-700 focus-within:text-white p-1.5 ms-auto -mx-1.5 -my-1.5 h-8 w-8 rounded-lg"
						aria-label="Fechar"
						type="button"
					>
						<span class="sr-only">Fechar</span>
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
						</svg>
					</button>
				</div>

				<div id="toast-error" class="invisible bg-gray-800 text-gray-200 flex items-center p-4 rounded-lg shadow transition-transform" role="alert" aria-hidden="true">
					<div class="bg-red-800 text-red-200 inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg" aria-hidden="true">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
							<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"></path>
						</svg>
					</div>
					<div class="message ms-3 text-sm"></div>
					<button
						class="bg-gray-800 inline-flex items-center justify-center text-gray-500 hover:bg-gray-700 hover:text-white focus-within:bg-gray-700 focus-within:text-white p-1.5 ms-auto -mx-1.5 -my-1.5 h-8 w-8 rounded-lg"
						aria-label="Fechar"
						type="button"
					>
						<span class="sr-only">Fechar</span>
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
						</svg>
					</button>
				</div>
			</div>

			<script>
				(() => {
				const toastSuccess = /** @type {HTMLDivElement | null} */ (document.getElementById("toast-success"))
				const toastError = /** @type {HTMLDivElement | null} */ (document.getElementById("toast-error"))
				const toastContainer = toastSuccess?.parentElement

				/** @type {Parameters<typeof clearTimeout>[0]} */ let toastErrorTimeout
				/** @type {Parameters<typeof clearTimeout>[0]} */ let toastSuccessTimeout

				toastSuccess.remove()
				toastSuccess.classList.remove("invisible")
				toastSuccess.ariaHidden = false

				toastError.remove()
				toastError.classList.remove("invisible")
				toastError.ariaHidden = false

				toastSuccess.querySelector("button").addEventListener("click", () => {
					clearTimeout(toastSuccessTimeout)
					toastSuccess.remove()
				})

				toastError.querySelector("button").addEventListener("click", () => {
					clearTimeout(toastErrorTimeout)
					toastError.remove()
				})

				function showToastSuccess(message = "Produto editado com sucesso!"){
					if(!toastSuccess) return

					const messageElement = /** @type {HTMLDivElement | null} */ (toastSuccess.querySelector(".message"))
					if(!messageElement) return

					toastSuccess.style.setProperty("transform", "translateX(110%)")
					messageElement.innerText = message
					toastContainer.appendChild(toastSuccess)

					setTimeout(() => toastSuccess.style.removeProperty("transform"), 10)

					clearTimeout(toastSuccessTimeout)
					toastSuccessTimeout = setTimeout(() => {
						toastSuccess.style.setProperty("transform", "translateX(150%)")
						toastSuccess.addEventListener("transitionend", function(){
							this.remove()
							resolve()
						}, { once: true })
					}, 5e3)
				}

				/** @param {string} message */
				function showToastError(message){
					if(!toastError) return

					const messageElement = /** @type {HTMLDivElement | null} */ (toastError.querySelector(".message"))
					if(!messageElement) return

					toastError.style.setProperty("transform", "translateX(110%)")
					messageElement.innerText = message
					toastContainer.appendChild(toastError)

					setTimeout(() => toastError.style.removeProperty("transform"), 10)

					clearTimeout(toastErrorTimeout)
					toastErrorTimeout = setTimeout(() => {
						toastError.style.setProperty("transform", "translateX(150%)")
						toastError.addEventListener("transitionend", function(){
							this.remove()
						}, { once: true })
					}, 5e3)
				}

				let loading = false

				document.forms[0].addEventListener("submit", async function(event){
					event.preventDefault()

					if(loading) return

					loading = true

					const submitButton = this.querySelector("[type=submit]")

					if(submitButton) submitButton.disabled = true

					try{
						const response = await fetch(this.action, {
							headers: {
								"Content-Type": this.enctype
							},
							body: new URLSearchParams(new FormData(this)),
							method: this.method,
							credentials: "include"
						})

						const data = await response.json()

						if(!data.success) throw data.message
						if(!response.ok) throw `A requisição falhou com status ${response.status}`

						showToastSuccess()

						if(submitButton){
							submitButton.disabled = false
							submitButton.blur()
						}

						loading = false
					}catch(error){
						if(submitButton) submitButton.disabled = false
						loading = false

						if(typeof error === "string"){
							showToastError(error)
							console.error(new Error(error))
							return
						}

						if(error instanceof Error && error.message){
							showToastError(error.message)
							console.error(error)
							return
						}

						showToastError("Algo deu errado!")
						console.error(error)
					}
				})
				})()
			</script>
		</main>
	</body>
</html>
