<?php
include_once 'model.php';
session_start();
$id = $_GET['id'] ?? -1;
$relations = $_SESSION['relations'] ?? [];
if (!isset($relations[$id])) die("Relation not found.");
$rel = $relations[$id];
$pokemons = $_SESSION['pokemons'] ?? [];
$types = $_SESSION['types'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Relation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Update Relation</h2>
  <form method="POST" action="controller.php">
    <input type="hidden" name="update_relation" value="1">
    <input type="hidden" name="index" value="<?= $id ?>">
    <div class="mb-3">
      <label>Pokemon</label>
      <select name="pokemon_id" class="form-select">
        <?php foreach($pokemons as $p): ?>
          <option value="<?= $p->id ?>" <?= $p->id == $rel->pokemon_id ? "selected" : "" ?>>
            <?= $p->name ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Type</label>
      <select name="type_id" class="form-select">
        <?php foreach($types as $t): ?>
          <option value="<?= $t->id ?>" <?= $t->id == $rel->type_id ? "selected" : "" ?>>
            <?= $t->name ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="view_relation.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
