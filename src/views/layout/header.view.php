<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic models</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
<header>
<nav>
  <ul>
    <li><a href="/"><strong>Classic models</strong></a></li>
  </ul>
  <ul>
    <?php if (isset($_SESSION['classicmodels_user'])): ?>
      <li>Bonjour <?= $_SESSION['classicmodels_user']['username'] ?></li>
      <li><a href="/logout">Logout</a></li>
      <?php else: ?>
    <li><a href="/login">Login</a></li>
    <li><a href="/register">Register</a></li>
    <?php endif; ?>
  </ul>
</nav>
</header>
<main class="container">
