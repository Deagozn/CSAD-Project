<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind CSS CDN link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-auto bg-repeat flex items-center justify-center h-screen" style="background-image: url('Resources/book-background.png')">
  
  <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <img src="Resources/logo-no-background.png" class="h-20 mr-5" alt="Kiasu Library Logo" style="margin-bottom: 30px; margin-left: 30%; width: 50%; height: auto"/>
    <h1 class="text-3xl font-semibold mb-6">Welcome Back :)</h1>
    <form>
      <div class="mb-6">
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input type="email" id="email" class="form-input mt-1 block w-full" placeholder="Enter your email" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input type="password" id="password" class="form-input mt-1 block w-full" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded">Sign In</button>
    </form>
    <div class="mt-4 text-center">
      <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Create Account</a>
      <span class="text-gray-500 mx-2">|</span>
      <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Forgot Password</a>
    </div>
  </div>

    
</body>
</html>
