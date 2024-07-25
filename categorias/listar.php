<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../login.php");

include "../conexao.php";

$categorias = mysqli_query($connection, "SELECT * FROM categoria ORDER BY nome ASC");
$categoriasArray = [];

if(mysqli_num_rows($categorias) > 0){
	while($categoria = mysqli_fetch_array($categorias)){
		$categoriasArray[] = $categoria;
	}
}

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

			<script src="https://unpkg.com/tabulator-tables@4.1.4/dist/js/tabulator.min.js"></script>
			<script>
				(() => {
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
								`<a href="editar.php?id=${cell.getRow().getData().id}" class="bg-yellow-600 hover:opacity-90 hover:shadow focus:bg-yellow-700 text-white inline-flex items-center text-center px-1 rounded select-none" role="button">Editar</button>` +
								`<a href="excluir.php?id=${cell.getRow().getData().id}" class="bg-red-600 hover:opacity-90 hover:shadow focus:bg-red-700 text-white inline-flex items-center text-center px-1 rounded select-none" role="button">Excluir</button>` +
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
				})()
			</script>
		</main>
	</body>
</html>
