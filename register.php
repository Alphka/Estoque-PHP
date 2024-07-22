<!DOCTYPE html>
<html lang="pt=BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login - Estoque</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link rel="stylesheet" href="./styles/global.css">
	</head>
	<body class="bg-gray-700 text-gray-50 min-h-dvh">
		<main>
			<header class="pt-8">
				<hgroup class="flex flex-col text-center gap-2">
					<h1 class="text-3xl font-bold leading-none">Cadastro</h1>
					<h2 class="text-xl font-semibold leading-normal">Crie uma conta</h2>
				</hgroup>
			</header>

			<form class="container max-w-md flex flex-col pt-8 px-4 mx-auto gap-4" action="api/cadastrar.php" method="POST">
				<div class="relative h-10">
					<input
						id="nome"
						name="nome"
						type="text"
						autocomplete="name"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						"
						placeholder
						required
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-sm
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
						Nome de usuário
					</label>
				</div>

				<div class="relative h-10">
					<input
						id="email"
						name="email"
						type="email"
						autocomplete="email"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						"
						placeholder
						required
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-slate-400 after:border-slate-400 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						"
						for="email"
						aria-hidden="true"
					>
						Email
					</label>
				</div>

				<div class="relative h-10">
					<input
						id="senha"
						name="senha"
						type="password"
						autocomplete="new-password"
						class="
							peer w-full h-full bg-transparent border border-t-transparent focus:border-t-transparent
							outline outline-0 focus:outline-0
							placeholder-shown:border placeholder-shown:border-slate-400 placeholder-shown:border-t-slate-400
							text-sm px-3 py-2.5 rounded-md border-slate-400 focus:border-2 focus:border-slate-200
							transition-all
						"
						placeholder
						required
					>
					<label
						class="
							flex w-full h-full truncate pointer-events-none absolute -top-1.5 left-0 select-none !overflow-visible
							text-gray-400 text-xs leading-tight peer-focus:leading-tight
							peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-sm
							peer-focus:text-xs
							before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1
							peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none peer-disabled:before:border-transparent
							after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r
							peer-focus:after:border-r-2 after:pointer-events-none
							peer-placeholder-shown:leading-[3.75] peer-focus:text-slate-200 before:border-slate-400 after:border-slate-400 peer-focus:before:!border-slate-200 peer-focus:after:!border-slate-200
							transition-all before:transition-all after:transition-all
						"
						for="senha"
						aria-hidden="true"
					>
						Senha
					</label>
				</div>

				<div class="relative w-full h-12">
					<select
						id="nivel"
						name="nivel"
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
						<option value hidden disabled selected>Selecione um dos itens</option>
						<option class="bg-gray-800" value="1">Administrador</option>
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
						for="nivel"
						aria-hidden="true"
					>
						Nível de acesso
					</label>
				</div>

				<button
					class="bg-blue-500 hover:opacity-95 hover:shadow focus:bg-blue-600 flex items-center px-3 py-1 w-fit mx-auto rounded select-none text-center"
					aria-label="Clique para enviar o formulário de cadastro"
					type="submit"
				>
					Cadastrar
				</button>
			</form>

			<script>
				(() => {
				const form = document.forms[0]
				const nomeElement = /** @type {HTMLInputElement} */ (form.elements.namedItem("nome"))
				const emailElement = /** @type {HTMLInputElement} */ (form.elements.namedItem("email"))
				const senhaElement = /** @type {HTMLInputElement} */ (form.elements.namedItem("senha"))

				let nomeChangeTimestamp, senhaChangeTimestamp

				function fixRenderInputs(elementToFocus = form.querySelector('[type="submit"]')){
					nomeElement.focus()
					emailElement.focus()
					senhaElement.focus()
					elementToFocus?.focus()
				}

				const interval = setInterval(fixRenderInputs)
				setTimeout(() => clearInterval(interval), 10)

				nomeElement.addEventListener("change", function(event){
					nomeChangeTimestamp = event.timeStamp
					if(nomeChangeTimestamp - senhaChangeTimestamp < 10) fixRenderInputs()
				})

				senhaElement.addEventListener("change", function(event){
					senhaChangeTimestamp = event.timeStamp
					if(senhaChangeTimestamp - nomeChangeTimestamp < 10) fixRenderInputs()
				})
				})()
			</script>
		</main>
	</body>
</html>
