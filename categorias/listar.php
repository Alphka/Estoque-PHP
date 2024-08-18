<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../login.html");

include "../conexao.php";

$categorias = mysqli_query($connection, "SELECT id, nome FROM categoria ORDER BY nome ASC");
$categoriasArray = [];

if(mysqli_num_rows($categorias) > 0){
	while($categoria = mysqli_fetch_array($categorias, MYSQLI_ASSOC)){
		$categoriasArray[] = $categoria;
	}
}

mysqli_free_result($categorias);
mysqli_close($connection);

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="color-scheme" content="dark">
		<title>Lista de categorias - Estoque</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link rel="stylesheet" href="../styles/global.css">
		<link rel="stylesheet" href="../styles/tabulator.css">
	</head>
	<body class="bg-gray-700 text-gray-50 min-h-dvh">
		<main>
			<header class="pt-8">
				<hgroup class="flex flex-col text-center gap-2">
					<h1 class="text-3xl font-bold leading-none">Lista de categorias</h1>
				</hgroup>
			</header>

			<div id="lista" class="w-11/12 mt-8 mb-4 mx-auto"></div>

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

			<script src="https://unpkg.com/tabulator-tables@4.1.4/dist/js/tabulator.min.js"></script>
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

				function showToastSuccess(message = "Categoria removida com sucesso!"){
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

				const categorias = <?php echo json_encode($categoriasArray) ?>

				const table = new Tabulator("#lista", {
					data: categorias,
					layout: "fitColumns",
					history: true,
					pagination: "local",
					paginationSize: 20,
					paginationCounter: "rows",
					initialSort: [
						{ column: "id", dir: "asc" }
					],
					columns: [
						{ field: "id", title: "ID", width: 120, headerFilter: "input", hozAlign: "center" },
						{ field: "nome", title: "Nome", headerFilter: "input" },
						{ title: "Ações", width: 108, headerSort: false, formatter: cell => (
							'<div class="flex items-center justify-center gap-1.5">' +
								`<a href="editar.php?id=${cell.getRow().getData().id}" class="bg-yellow-600 hover:opacity-90 hover:shadow focus:bg-yellow-700 text-white inline-flex items-center text-center px-1 rounded select-none" role="button">Editar</a>` +
								`<form action="../api/categorias/excluir.php?id=${cell.getRow().getData().id}" method="POST" onsubmit="handleDeleteFormSubmit.call(this, event, '${cell.getRow().getData().id}')">` +
									`<button class="bg-red-600 hover:opacity-90 hover:shadow focus:bg-red-700 text-white inline-flex items-center text-center px-1 rounded select-none" type="submit">Excluir</button>` +
								"</form>" +
							"</div>"
						), columnVertAlign: "center", hozAlign: "center" }
					],
					locale: "pt-BR",
					langs: {
						"pt-BR": {
							data: {
								loading: "Carregando",
								error: "Erro"
							},
							groups: {
								item: "item",
								items: "itens"
							},
							pagination: {
								page_size: "Tamanho da página",
								page_title: "Mostrar página",
								first: "Primeira",
								first_title: "Primeira página",
								last: "Última",
								last_title: "Última página",
								prev: "Anterior",
								prev_title: "Página anterior",
								next: "Próxima",
								next_title: "Próxima página",
								all: "Todos",
								counter: {
									showing: "Mostrando",
									of: "de",
									rows: "linhas",
									pages: "páginas"
								}
							},
							headerFilters: {
								default: "filtrar coluna...",
								columns: {
									name: "filtrar nome..."
								}
							}
						}
					}
				})

				/**
				 * @this {HTMLFormElement}
				 * @param {SubmitEvent} event
				 * @param {string} rowId
				 */
				async function handleDeleteFormSubmit(event, rowId){
					event.preventDefault()

					const button = this.querySelector("button")

					/** @param {boolean} isLoading */
					const setLoading = isLoading => {
						button.disabled = isLoading
						this.dataset.disabled = String(isLoading)
					}

					try{
						if(!button) throw "Button not found"
						if(button.disabled || this.dataset.disabled === "true") return

						setLoading(true)

						const response = await fetch(this.action, {
							method: this.method,
							credentials: "include"
						})

						let responseText, data
						try{
							responseText = await response.text()
							data = JSON.parse(responseText)
						}catch(error){
							throw ["Algo deu errado na resposta da requisição", responseText]
						}

						if(!data.success) throw data.message
						if(!response.ok) throw `A requisição falhou com status ${response.status}`

						await table.deleteRow(rowId)
						categorias.splice(categorias.findIndex(categoria => categoria.id === rowId), 1)

						showToastSuccess()
						setLoading(false)
					}catch(error){
						setLoading(false)

						if(Array.isArray(error)){
							showToastError(error[0])
							console.error(error[1])
							return
						}

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
				}

				window.handleDeleteFormSubmit = handleDeleteFormSubmit
				})()
			</script>
		</main>
	</body>
</html>
