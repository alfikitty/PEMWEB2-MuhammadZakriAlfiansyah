<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-white shadow-md h-screen">
            <div class="p-4">
                <h2 class="text-2xl font-bold text-blue-600">Dashboard</h2>
                <nav class="mt-6">
                    <ul>
                        <li>
                            <a href="kelurahan/index.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-blue-100 rounded transition">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                Kelurahan Management
                            </a>
                        </li>
                        <li>
                            <a href="unit_kerja/index.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-blue-100 rounded transition">
                                <i class="fas fa-briefcase mr-2"></i>
                                Unit Kerja Management
                            </a>
                        </li>
                        <li>
                            <a href="pasien/index.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-blue-100 rounded transition">
                                <i class="fas fa-user-injured mr-2"></i>
                                Pasien Management
                            </a>
                        </li>
                        <li>
                            <a href="paramedik/index.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-blue-100 rounded transition">
                                <i class="fas fa-user-md mr-2"></i>
                                Paramedik Management
                            </a>
                        </li>
                        <li>
                            <a href="periksa/index.php" class="flex items-center py-2 px-4 text-gray-700 hover:bg-blue-100 rounded transition">
                                <i class="fas fa-stethoscope mr-2"></i>
                                Periksa Management
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6">Welcome to the Healthcare Management Dashboard</h1>
            <!-- Additional content can go here -->
        </main>
    </div>
</body>
</html>