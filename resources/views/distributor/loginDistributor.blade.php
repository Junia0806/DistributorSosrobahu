<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Distributor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-no-repeat bg-login bg-cover">
    <div class="w-full max-w-md mx-auto mt-10 px-4 md:px-0 py-8">
        <!-- Transparan card dengan opacity -->
        <div class="bg-white bg-opacity-55 rounded-lg shadow-lg p-8">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Login</h1>
                <p class="text-lg text-gray-600">Sebagai Distributor</p>
            </div>

            <form action="{{ route('loginDistributor') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-800">Username</label>
                    <input type="text" id="username" name="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-3"
                        required />
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-3"
                        required />
                </div>
                <div>
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-700 focus:ring-2 focus:ring-gray-300 font-medium rounded-lg text-sm py-2.5">
                        Login
                    </button>
                </div>

                @if ($errors->any())
                    <div class="text-red-600 text-sm mt-3">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif
            </form>
            
        </div>
    </div>
</body>

</html>
