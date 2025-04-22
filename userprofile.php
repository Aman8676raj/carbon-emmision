<?php
session_start();
require_once 'php/db.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: login.html');
  exit();
}
$user_id = $_SESSION['user_id'];
$user_stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$user_stmt->execute([$user_id]);
$user = $user_stmt->fetch();
$data_stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY calculated_at DESC");
$data_stmt->execute([$user_id]);
$data = $data_stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>User Profile - EcoTrack</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">
  <header class="shadow-md bg-white sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center p-4">
      <h1 class="text-2xl font-bold text-green-700 flex items-center gap-2">
        <img src="https://img.icons8.com/ios-filled/50/26e07f/leaf.png" class="w-6 h-6"> EcoTrack
      </h1>
      <nav class="space-x-4 hidden md:block">
        <a href="index.html" class="text-green-700 hover:underline">Home</a>
        <a href="calculator.html" class="text-green-700 hover:underline">Calculator</a>
        <a href="dashboard.html" class="text-green-700 hover:underline">Dashboard</a>
        <a href="about.html" class="text-green-700 hover:underline">About</a>
        <a href="info.html" class="text-green-700 hover:underline">Info</a>
      </nav>
    </div>
  </header>

  <div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-xl">
    <h2 class="text-3xl font-bold text-green-700 mb-4">Welcome, <?= htmlspecialchars($user['username']) ?> 👋</h2>
    <p class="mb-4 text-gray-700">Email: <strong><?= htmlspecialchars($user['email']) ?></strong></p>
    <?php if ($calculations = $data_stmt->fetchAll()): ?>
    <div class="mb-8">
      <h3 class="text-2xl font-bold text-green-700 mb-4">Your Carbon Footprint History</h3>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
          <thead>
            <tr class="bg-green-100">
              <th class="border p-3 text-left">Date</th>
              <th class="border p-3 text-right">Electricity (kWh)</th>
              <th class="border p-3 text-right">Gas (m³)</th>
              <th class="border p-3 text-right">Water (L)</th>
              <th class="border p-3 text-right font-bold">Total Emissions (kg CO₂e)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($calculations as $calc): ?>
            <tr class="hover:bg-gray-50">
              <td class="border p-3"><?= date('F j, Y g:i A', strtotime($calc['calculated_at'])) ?></td>
              <td class="border p-3 text-right"><?= number_format($calc['electricity_consumption'], 2) ?></td>
              <td class="border p-3 text-right"><?= number_format($calc['gas_consumption'], 2) ?></td>
              <td class="border p-3 text-right"><?= number_format($calc['water_consumption'], 2) ?></td>
              <td class="border p-3 text-right font-bold text-green-700"><?= number_format($calc['carbon_footprint'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-6 text-center">
      <a href="calculator.html" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Recalculate</a>
    </div>
    <?php else: ?>
    <p>No data found. Please <a href="calculator.html" class="text-green-600 underline">calculate now</a>.</p>
    <?php endif; ?>
  </div>
</body>
</html>
