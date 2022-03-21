<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="grid place-items-center h-screen bg-gray-200 rounded shadow-sm">
        <section id="form" class="bg-gray-200">
            <form action="" method="POST"
            class="flex flex-col rounded shadow space-y-3 p-7">
            @csrf
            @method('POST')

                <h2 class="text-center">Produto</h2>
                <input type="text" name="title" required>
                <input type="text" name="description" required>
                <button class="mt-10 py-2 rounded shadow bg-slate-900 font-bold text-white"
                type="submit">cadastrar</button>

            </form>
        </section>
    </div>
</body>
</html>