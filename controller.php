<?php
// controller.php
include_once 'model.php';
session_start();

if (!isset($_SESSION['initialized'])) {
    $_SESSION['pokemons'] = [
        new Pokemon(1, "Pikachu", 6.0, "Mouse"),
        new Pokemon(2, "Charmander", 8.5, "Lizard"),
        new Pokemon(3, "Bulbasaur", 6.9, "Seed")
    ];

    $_SESSION['types'] = [
        new Type(1, "Electric", "Strong vs Water", "Weak vs Ground"),
        new Type(2, "Fire", "Strong vs Grass", "Weak vs Water"),
        new Type(3, "Grass", "Strong vs Water", "Weak vs Fire")
    ];

    $_SESSION['relations'] = [
        new Relation(1, 1), 
        new Relation(2, 2), 
        new Relation(3, 3) 
    ];

    $_SESSION['next_pokemon_id'] = 4;
    $_SESSION['next_type_id'] = 4;
    $_SESSION['initialized'] = true;
}

if (isset($_POST['add_pokemon'])) {
    $id = $_SESSION['next_pokemon_id']++;
    $pokemon = new Pokemon($id, $_POST['name'], $_POST['weight'], $_POST['species']);
    $_SESSION['pokemons'][] = $pokemon;
    header("Location: view_pokemon.php");
    exit;
}

if (isset($_POST['update_pokemon'])) {
    $id = (int)$_POST['id'];
    foreach ($_SESSION['pokemons'] as $p) {
        if ($p->id == $id) {
            $p->name = $_POST['name'];
            $p->weight = $_POST['weight'];
            $p->species = $_POST['species'];
        }
    }
    header("Location: view_pokemon.php");
    exit;
}

if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    foreach ($_SESSION['pokemons'] as $k => $p) {
        if ($p->id == $id) unset($_SESSION['pokemons'][$k]);
    }
    foreach ($_SESSION['relations'] as $rk => $rel) {
        if ($rel->pokemon_id == $id) unset($_SESSION['relations'][$rk]);
    }
    $_SESSION['pokemons'] = array_values($_SESSION['pokemons']);
    $_SESSION['relations'] = array_values($_SESSION['relations']);
    header("Location: view_pokemon.php");
    exit;
}

if (isset($_POST['add_relation'])) {
    $_SESSION['relations'][] = new Relation($_POST['pokemon_id'], $_POST['type_id']);
    header("Location: view_relation.php");
    exit;
}

if (isset($_POST['update_relation'])) {
    $index = (int)$_POST['index'];
    if (isset($_SESSION['relations'][$index])) {
        $_SESSION['relations'][$index]->pokemon_id = $_POST['pokemon_id'];
        $_SESSION['relations'][$index]->type_id = $_POST['type_id'];
    }
    header("Location: view_relation.php");
    exit;
}

if (isset($_GET['delete_rel_id'])) {
    $index = (int)$_GET['delete_rel_id'];
    if (isset($_SESSION['relations'][$index])) {
        unset($_SESSION['relations'][$index]);
        $_SESSION['relations'] = array_values($_SESSION['relations']);
    }
    header("Location: view_relation.php");
    exit;
}
