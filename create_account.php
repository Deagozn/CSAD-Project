<!DOCTYPE h
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <!-- Tailwind CSS CDN link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-auto bg-repeat flex items-center justify-center" style="background-image: url('Resources/book-background.png'); height: auto">
  
  <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8 ">
    <img src="Resources/logo-no-background.png" class="h-20 mr-5" alt="Kiasu Library Logo" style=" margin-bottom: 5%; margin-left: 30%; width: 50%; height: auto;"/>
    <h1 class="text-3xl font-semibold mb-6">Create Your Account</h1>
    <form>
      <div class="mb-6">
        <label for="name" class="block text-gray-700 font-medium">Name</label>
        <input type="text" id="name" class="form-input mt-1 block w-full" placeholder="Enter your name" required>
      </div>
      <div class="mb-6">
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input type="email" id="email" class="form-input mt-1 block w-full" placeholder="Enter your email" required>
      </div>
      <div class="mb-6">
        <label for="phone_number" class="block text-gray-700 font-medium">Phone Number</label>
        <input type="number" id="phone_number" class="form-input mt-1 block w-full" placeholder="Enter your phone number" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input type="password" id="password" class="form-input mt-1 block w-full" placeholder="Enter your password" required>
      </div>
      <div class="mb-6">
        <label for="cfm_password" class="block text-gray-700 font-medium">Confirm Password</label>
        <input type="password" id="cfm_password" class="form-input mt-1 block w-full" placeholder="Re-enter your password" required>
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded">Create Account</button>
    </form>
  </div>

</body>
</html>


