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

    public function valeurTotale(): float
    {
        $total = 0.0;
        foreach ($this->produits as $p) {
            $total += $p->valeurStock();
        }
        return $total;
    }

    public function produitsEnRupture(): array
    {
        return array_values(array_filter($this->produits, fn($p) => $p->getQuantite() === 0));
    }

    public function produitsSousSeuil(int $seuil): array
    {
        return array_values(array_filter($this->produits, fn($p) => $p->getQuantite() < $seuil));
    }
}

# fix commit name