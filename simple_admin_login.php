<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simple hardcoded admin credentials
    $admin_username = "admin";
    $admin_password = "admin123";
    
    // Get user input
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    
    // Simple validation
    if ($username === $admin_username && $password === $admin_password) {
        // Set session variables
        $_SESSION["admin_id"] = 1;
        $_SESSION["admin_username"] = $username;
        
        // Redirect to admin dashboard
        header("Location: php/admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Admin Login - EcoTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f9f0;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-lime-50 min-h-screen flex flex-col">
    <header class="shadow-sm bg-white sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="index.html" class="text-xl font-semibold text-green-700 flex items-center gap-2">
                <img src="https://img.icons8.com/ios-filled/50/26e07f/leaf.png" alt="logo" class="w-6 h-6">
                <span>EcoTrack</span>
            </a>
            <nav class="flex items-center space-x-4">
                <a href="index.html" class="text-green-600 hover:underline">Home</a>
            </nav>
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center p-6">
        <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ri-admin-line text-3xl text-green-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
                <p class="text-gray-600 mt-2">Simple login that works!</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4">
                    <p class="flex items-center"><i class="ri-error-warning-line mr-2"></i> <?php echo $error; ?></p>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <i class="ri-user-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="username" name="username" required
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <i class="ri-lock-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="password" name="password" required
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                    </div>
                </div>
                
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-green-600 to-green-500 text-white font-medium rounded-xl hover:from-green-500 hover:to-green-400 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="ri-login-box-line"></i>
                    Login
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">Username: admin | Password: admin123</p>
            </div>
        </div>
    </main>
    
    <footer class="py-4 text-center text-gray-600 bg-white border-t">
        <p>© 2025 EcoTrack. All rights reserved.</p>
    </footer>
</body>
</html>
