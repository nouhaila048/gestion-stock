<?php
class Commande
{
    private array $lignes = [];
    private bool $validee = false;

    public function __construct(private int $numero)
    {
    }

    public function ajouterLigne(Produit $p, int $quantite): void
    {
        if ($this->validee) {
            throw new LogicException("Commande déjà validée.");
        }
        if ($quantite <= 0) {
            throw new InvalidArgumentException("La quantité doit être positive.");
        }
        $dejaCommande = 0;
        foreach ($this->lignes as $ligne) {
            if ($ligne['produit']->getReference() === $p->getReference()) {
                $dejaCommande += $ligne['quantite'];
            }
        }
        if ($quantite + $dejaCommande > $p->getQuantite()) {
            throw new InvalidArgumentException("Stock insuffisant pour " . $p->getNom());
        }
        $this->lignes[] = ['produit' => $p, 'quantite' => $quantite];
    }

    public function total(): float
    {

        $total = 0.0;
        foreach ($this->lignes as $ligne) {
            $total += $ligne['produit']->getPrix() * $ligne['quantite'];
        }
        return $total;
    }
        public function valider(): void
    {
        if ($this->validee) {
            throw new LogicException("Commande déjà validée.");
        }
        if (empty($this->lignes)) {
            throw new LogicException("Impossible de valider une commande vide.");
        }
        foreach ($this->lignes as $ligne) {
            $ligne['produit']->retirerQuantite($ligne['quantite']);
        }
        $this->validee = true;
    }

    public function estValidee(): bool
    {
        return $this->validee;
    }
}