<?php
class Pokemon {
    public $id;
    public $name;
    public $weight;
    public $species;

    public function __construct($id, $name, $weight, $species) {
        $this->id = $id;
        $this->name = $name;
        $this->weight = $weight;
        $this->species = $species;
    }
}

class Type {
    public $id;
    public $name;
    public $pro;
    public $contra;

    public function __construct($id, $name, $pro, $contra) {
        $this->id = $id;
        $this->name = $name;
        $this->pro = $pro;
        $this->contra = $contra;
    }
}

class Relation {
    public $pokemon_id;
    public $type_id;

    public function __construct($pokemon_id, $type_id) {
        $this->pokemon_id = $pokemon_id;
        $this->type_id = $type_id;
    }
}
