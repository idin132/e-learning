<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eduvi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-600 rounded-xl text-white mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.216 50.59 50.59 0 00-2.658.812m-15.482 0a50.57 50.57 0 012.658.812m12.824 0a50.57 50.57 0 00-2.658-.812" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
                <p class="text-gray-500 text-sm mt-2">Please enter your details to sign in.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
                        placeholder="student@eduvi.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-gray-500 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-blue-500/30">
                    Sign in
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5 mr-2" alt="Google">
                    <span class="text-sm font-medium text-gray-600">Google</span>
                </button>
                <button class="flex items-center justify-center py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="h-5 w-5 mr-2" alt="Facebook">
                    <span class="text-sm font-medium text-gray-600">Facebook</span>
                </button>
            </div>

            <p class="text-center text-sm text-gray-500 mt-8">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-500">Sign up</a>
            </p>
        </div>
    </div>
</body>
</html>