<?php

// Définition des caractéristiques communes à tous les personnages
class Personnage {
    public $pointsDeVie;
    public $pointsDAttaque;
    public $armure;

    public function __construct($pointsDeVie, $pointsDAttaque, $armure) {
        $this->pointsDeVie = $pointsDeVie;
        $this->pointsDAttaque = $pointsDAttaque;
        $this->armure = $armure;
    }

    public function attaquer(Personnage $cible) {
        $degats = max(0, $this->pointsDAttaque - $cible->armure);
        $cible->prendreDegats($degats);
    }

    public function prendreDegats($degats) {
        $degats = max(0, $degats - $this->armure);
        $this->pointsDeVie -= $degats;
    }

    public function estVivant() {
        return $this->pointsDeVie > 0;
    }
}

// Définition du héros
class Heros extends Personnage {
    public $bonusVie;
    public $bonusArmure;

    public function __construct() {
        parent::__construct(200, 15, 0);
        $this->bonusVie = 0;
        $this->bonusArmure = 0;
    }

    public function prendreBonusVie($valeur) {
        $this->bonusVie = $valeur;
        $this->pointsDeVie += $valeur;
    }

    public function prendreBonusArmure($valeur) {
        $this->bonusArmure = $valeur;
        $this->armure += $valeur;
    }

    public function enleverBonusArmure() {
        $this->armure -= $this->bonusArmure;
        $this->bonusArmure = 0;
    }
}

// Définition des ennemis
class Minion extends Personnage {
    public function __construct() {
        parent::__construct(10, 10, 0);
    }
}

class LieutenantMinion extends Personnage {
    public function __construct() {
        parent::__construct(30, 30, 0);
    }
}

class ChefMinion extends Personnage {
    public function __construct() {
        parent::__construct(100, 100, 0);
    }
}

// Déroulement du combat
$hero = new Heros();
$minion1 = new Minion();
$minion2 = new Minion();
$lieutenant = new LieutenantMinion();
$chef = new ChefMinion();

echo "Début du combat !" . PHP_EOL;

// Le héros attaque le premier minion
$hero->attaquer($minion1);
if (!$minion1->estVivant()) {
    echo "Le minion est mort." . PHP_EOL;
}

// Le premier ennemi attaque le héros
$minion1->attaquer($hero);
if (!$hero->estVivant()) {
    echo "Le héros est mort." . PHP_EOL;
}

// Le héros prend un bonus de vie
$hero->prendreBonusVie(50);

// Le deuxième ennemi attaque le héros
$minion2->attaquer($hero);
if (!$hero->estVivant()) {
    echo "héros est mort." . PHP_EOL;
}

// Le héros prend un bonus d'armure
$hero->prendreBonusArmure(20);

// Le lieutenant ennemi attaque le héros
$lieutenant->attaquer($hero);
if (!$hero->estVivant()) {
echo "Le héros est mort." . PHP_EOL;
}

// Le héros enlève le bonus d'armure
$hero->enleverBonusArmure();

// Le chef ennemi attaque le héros
$chef->attaquer($hero);
if (!$hero->estVivant()) {
echo "Le héros est mort." . PHP_EOL;
}

// Fin du combat
echo "Fin du combat !" . PHP_EOL;

?>