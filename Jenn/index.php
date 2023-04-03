<?php
class Personnage {
  // Properties
  public $name;
  public $armure;
  public $vie;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
}

$heros = new Personnage();
$ennemis = new Personnage();
$ennemisLieutenant = new Personnage();
$ennemisChef = new Personnage();

$heros->set_name('Héros');
$ennemis->set_name('Minion');
$ennemisLieutenant->set_name('Lieutenant Minion');
$ennemiChef->set_name('Chef Minion');

$heros->set_vie(200);
$ennemis->set_vie(10);
$ennemisLieutenant->set_vie(30);
$ennemisChef->set_vie(100);




echo $heros->get_name();

echo $ennemis->get_name();
?>