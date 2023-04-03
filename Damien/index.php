<?php
class Personnage {
    private $nom;
    private $points_de_vie;
    private $points_d_attaque;

    public function __construct($nom, $points_de_vie, $points_d_attaque) {
        $this->nom = $nom;
        $this->points_de_vie = $points_de_vie;
        $this->points_d_attaque = $points_d_attaque;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPointsDeVie() {
        return $this->points_de_vie;
    }

    public function getPointsDAttaque() {
        return $this->points_d_attaque;
    }

    public function attaquer(Personnage $cible) {
        $cible->subirDegats($this->points_d_attaque);
    }

    public function subirDegats($degats) {
        $this->points_de_vie -= $degats;
    }

    public function estVivant() {
        return $this->points_de_vie > 0;
    }
}

class Combat {
    private $heros;
    private $ennemis;

    public function __construct(Personnage $heros, array $ennemis) {
        $this->heros = $heros;
        $this->ennemis = $ennemis;
    }

    public function lancer() {
        echo "Un combat épique commence entre " . $this->heros->getNom() . " et les ennemis !" . PHP_EOL;
        while ($this->heros->estVivant() && count($this->ennemis) > 0) {
            $cible = $this->ennemis[array_rand($this->ennemis)];
            $this->heros->attaquer($cible);
            if (!$cible->estVivant()) {
                echo $cible->getNom() . " a été vaincu !" . PHP_EOL;
                $key = array_search($cible, $this->ennemis);
                unset($this->ennemis[$key]);
                $this->ennemis = array_values($this->ennemis);
            } else {
                foreach ($this->ennemis as $ennemi) {
                    if ($ennemi->estVivant()) {
                        $ennemi->attaquer($this->heros);
                    }
                }
            }
        }
        if ($this->heros->estVivant()) {
            echo "Bravo ! " . $this->heros->getNom() . " a remporté la victoire !" . PHP_EOL;
        } else {
            echo "Oh non ! " . $this->heros->getNom() . " a été vaincu !" . PHP_EOL;
        }
    }
}

// Exemple d'utilisation :
$heros = new Personnage("Héros", 150, 20);
$ennemis = [
    new Personnage("Ennemi 1", 50, 10),
    new Personnage("Ennemi 2", 60, 12),
    new Personnage("Ennemi 3", 70, 15),
];

$combat = new Combat($heros, $ennemis);
$combat->lancer();
?>
