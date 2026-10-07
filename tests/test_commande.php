<?php
$prodCmd = new Produit('C001', 'Casque', 200, 5);
$cmd = new Commande(1);
$cmd->ajouterLigne($prodCmd, 2);

verifier(abs($cmd->total() - 400) < 0.001, 'Total commande = 2 x 200');
verifier($cmd->estValidee() === false, 'Commande non validée au départ');

$cmd->valider();
verifier($cmd->estValidee() === true, 'Commande validée après valider()');
verifier($prodCmd->getQuantite() === 3, 'Le stock du produit passe de 5 à 3');


try {
    $cmd->valider();
    verifier(false, 'Double validation doit lever une exception');
} catch (LogicException $e) {
    verifier(true, 'Double validation refusée');
}

try {
    $cmd2 = new Commande(2);
    $cmd2->ajouterLigne($prodCmd, 99);
    verifier(false, 'Quantité > stock doit lever une exception');
} catch (InvalidArgumentException $e) {
    verifier(true, 'Quantité supérieure au stock refusée');
}

try {
    $cmd3 = new Commande(3);
    $cmd3->valider();
    verifier(false, 'Commande vide doit lever une exception');
} catch (LogicException $e) {
    verifier(true, 'Validation d\'une commande vide refusée');
}