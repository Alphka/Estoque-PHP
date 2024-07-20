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
					<h1 class="text-3xl font-bold leading-none">Login</h1>
					<h2 class="text-xl font-semibold leading-normal">Entre na sua conta</h2>
				</hgroup>
			</header>

			<form class="container flex flex-col pt-8 px-4 mx-auto gap-4" action="api/autenticar.php" method="POST">
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
					>
						Nome de usuário
					</label>
				</div>

				<div class="relative h-10">
					<input
						id="senha"
						name="senha"
						type="password"
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
					>
						Senha
					</label>
				</div>

				<button
					class="bg-blue-500 hover:opacity-95 hover:shadow focus:bg-blue-400 flex items-center px-3 py-1 w-fit mx-auto rounded select-none text-center"
					type="submit"
				>
					Entrar
				</button>
			</form>

			<p class="text-center mt-4">
				Não possui cadastro?
				<a class="underline font-semibold text-gray-50 hover:text-opacity-90 focus:text-gray-200" autofocus href="register.php">Registre-se</a>!
			</p>
		</main>
	</body>
</html>
