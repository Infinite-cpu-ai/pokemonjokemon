<?php
include_once 'model.php';
session_start();
$id = $_GET['id'] ?? 0;
$pokemon = null;
foreach ($_SESSION['pokemons'] as $p) {
    if ($p->id == $id) $pokemon = $p;
}
if (!$pokemon) die("Pokemon not found.");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Pokemon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Update Pokemon</h2>
  <form method="POST" action="controller.php">
    <input type="hidden" name="update_pokemon" value="1">
    <input type="hidden" name="id" value="<?= $pokemon->id ?>">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($pokemon->name) ?>" required>
    </div>
    <div class="mb-3">
      <label>Weight</label>
      <input type="number" step="0.1" name="weight" class="form-control" value="<?= htmlspecialchars($pokemon->weight) ?>" required>
    </div>
    <div class="mb-3">
      <label>Species</label>
      <input type="text" name="species" class="form-control" value="<?= htmlspecialchars($pokemon->species) ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="view_pokemon.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
