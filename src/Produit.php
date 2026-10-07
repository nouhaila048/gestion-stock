<?php

class Produit
{
    private string $reference;
    private string $nom;
    private float $prix;
    private int $quantite;

    public function __construct(string $reference, string $nom, float $prix, int $quantite = 0)
    {
        if ($prix < 0) {
            throw new InvalidArgumentException("Le prix ne peut pas etre negatif");
        }
        if ($quantite < 0) {
            throw new InvalidArgumentException("La quantite ne peut pas etre negative");
        }
        $this->reference = $reference;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }

    public function getReference(): string { return $this->reference; }
    public function getNom(): string { return $this->nom; }
    public function getPrix(): float { return $this->prix; }
    public function getQuantite(): int { return $this->quantite; }

    public function ajouterQuantite(int $n): void
    {
        if ($n <= 0) {
            throw new InvalidArgumentException("La quantite a ajouter doit etre positive");
        }
        $this->quantite += $n;
    }

    public function retirerQuantite(int $n): void
    {
        if ($n > $this->quantite) {
            throw new InvalidArgumentException("Stock insuffisant");
        }
        $this->quantite -= $n;
    }

    public function valeurStock(): float
    {
        return $this->prix * $this->quantite;
    }
}