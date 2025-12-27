<?php
require_once 'core/auth.php';
require_login(); 
require_once 'core/db.php';

$current_page = $_GET['page'] ?? 'surat_masuk';
$surat_id = $_GET['id'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail - Inbox</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .mail-list-col { width: 320px; flex-shrink: 0; }
        .mail-item { transition: all 0.2s; border-left: 3px solid transparent; }
        .mail-item:hover { background-color: #f1f5f9; }
        .mail-item.active { background-color: #e0f2fe; border-left-color: #3b82f6; }
        .mail-subject { overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
        .avatar { background-color: #3b82f6; color: white; width: 40px; height: 40px; border-radius: 50%; text-align: center; line-height: 40px; font-weight: bold; font-size: 16px; flex-shrink: 0; }
    </style>
</head>
<body class="flex h-screen bg-gray-100 antialiased">

    <div class="sidebar w-64 bg-white border-r border-gray-200 p-4 flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-blue-600 mb-6">Mail</h1>
            <nav class="space-y-1">
                <a href="index.php?page=surat_masuk" class="flex items-center p-3 text-gray-700 rounded-lg transition <?php echo ($current_page == 'surat_masuk') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-100'; ?>">
                    Inbox (Surat Masuk)
                    <span class="ml-auto text-xs bg-gray-200 px-2 py-0.5 rounded-full">6</span>
                </a>
                <a href="index.php?page=surat_keluar" class="flex items-center p-3 text-gray-700 rounded-lg transition <?php echo ($current_page == 'surat_keluar') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-100'; ?>">
                    Surat Keluar
                </a>
                <a href="index.php?page=tulis_surat_keluar" class="w-full block text-center bg-blue-600 text-white py-3 rounded-full font-semibold shadow-md hover:bg-blue-700 transition mb-6">
    + Tulis Surat
</a>
                <a href="logout.php" class="flex items-center p-3 text-red-600 rounded-lg hover:bg-red-50 transition mt-4 border-t pt-4">
                    Logout (<?php echo $_SESSION['user_name']; ?>)
                </a>
            </nav>
        </div>
    </div>

    <div class="main-content flex-1 flex overflow-hidden">
        <?php
        // Logika Routing untuk memuat view
        if ($current_page == 'surat_masuk') {
            include 'views/surat_masuk.php';
        } elseif ($current_page == 'surat_keluar') {
            include 'views/daftar_surat_keluar.php';
        } elseif ($current_page == 'tulis_surat_keluar') {
            include 'views/form_surat_keluar.php';
        } else {
            include 'views/surat_masuk.php'; // Default ke surat masuk
        }
        ?>
    </div>

</body>
</html>