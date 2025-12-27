<?php
require_once 'core/auth.php';
require_once 'core/db.php';

if (is_logged_in()) {
    header("Location: index.php");
    exit();
}

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, nama, email, password FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Bandingkan password dengan MD5 hash
        if (MD5($password) == $user['password']) { 
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['nama'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: index.php");
            exit();
        } else {
            $login_error = "Email atau Password salah.";
        }
    } else {
        $login_error = "Email atau Password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Kantor - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-slate-100 flex items-center justify-center p-4">
    
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fadeIn">
            <div class="grid md:grid-cols-2 gap-0">
                
                <div class="hidden md:flex bg-blue-600 p-12 flex-col justify-between">
                    <div>
                        <h1 class="text-white text-3xl font-bold mb-4">✉️ Mail Kantor</h1>
                        <p class="text-blue-200 mb-8">Sistem email perusahaan yang aman dan terpercaya.</p>
                        <ul class="text-white list-none p-0">
                            <li class="mb-3 flex items-center">✓ Keamanan tingkat enterprise</li>
                            <li class="mb-3 flex items-center">✓ Akses dari berbagai perangkat</li>
                            <li class="mb-3 flex items-center">✓ Penyimpanan unlimited</li>
                        </ul>
                    </div>
                </div>

                <div class="p-10 lg:p-16 flex flex-col justify-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang</h2>
                    <p class="text-gray-500 mb-8">Masuk dengan akun email perusahaan Anda</p>
                    
                    <form method="POST" class="space-y-6">
                        <input type="hidden" name="login" value="1">

                        <?php if ($login_error): ?>
                            <div class="error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm" role="alert">
                                <span class="block sm:inline"><?php echo $login_error; ?></span>
                            </div>
                        <?php endif; ?>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Kantor</label>
                            <input type="email" id="email" name="email" required placeholder="nama@perusahaan.co.id" class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" id="password" name="password" required placeholder="Masukkan password" class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Masuk ke Mailbox
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>