<?php
$s = new Stock();
$s->ajouter(new Produit('P001', 'Clavier', 150, 10));
$s->ajouter(new Produit('P002', 'Souris', 20, 0));
$s->ajouter(new Produit('P003', 'Ecran', 300, 2));

verifier($s->compter() === 3, 'Le stock contient 3 produits');
verifier($s->trouver('P001')?->getNom() === 'Clavier', 'trouver() retourne le bon produit');
verifier($s->trouver('XXX') === null, 'trouver() retourne null si inconnu');
verifier(abs($s->valeurTotale() - 2100) < 0.001, 'Valeur totale = 1500 + 0 + 600');
verifier(count($s->produitsEnRupture()) === 1, 'Un produit en rupture');
verifier(count($s->produitsSousSeuil(5)) === 2, 'Deux produits sous le seuil 5');

try {
    $s->ajouter(new Produit('P001', 'Doublon', 10, 1));
    verifier(false, 'Reference en double lève une exception');
} catch (InvalidArgumentException $e) {
    verifier(true, 'Reference en double lève une exception');
}