<?php

class Stock
{
    private array $produits = [];

    public function ajouter(Produit $p): void
    {
        if (isset($this->produits[$p->getReference()])) {
            throw new InvalidArgumentException("Reference deja existante");
        }
        $this->produits[$p->getReference()] = $p;
    }

    public function trouver(string $reference): ?Produit
    {
        return $this->produits[$reference] ?? null;
    }

    public function tous(): array { return array_values($this->produits); }

    public function compter(): int { return count($this->produits); }
}