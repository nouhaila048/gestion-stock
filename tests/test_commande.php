<?php
$prodCmd = new Produit('C001', 'Casque', 200, 5);
$cmd = new Commande(1);
$cmd->ajouterLigne($prodCmd, 2);

verifier(abs($cmd->total() - 400) < 0.001, 'Total commande = 2 x 200');
verifier($cmd->estValidee() === false, 'Commande non validée au départ');

$cmd->valider();
verifier($cmd->estValidee() === true, 'Commande validée après valider()');
verifier($prodCmd->getQuantite() === 3, 'Le stock du produit passe de 5 à 3');