<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md mx-auto mt-16 px-4 md:px-0">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-6 text-center">
                <h1 class="text-4xl font-bold text-gray-900">LOGIN</h1>
                <p class="text-xl text-gray-700">SEBAGAI SALES</p>
            </div>

            <form action="/login-sales" method="POST" class="max-w-sm mx-auto">
                @csrf
                <div class="mb-5">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required />
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        LOGIN
                    </button>
                </div>
            </form>            
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>
