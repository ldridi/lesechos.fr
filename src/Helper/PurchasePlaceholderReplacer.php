<?php

class PurchasePlaceholderReplacer implements PlaceholderReplacer
{
    public function replacePlaceholders(string $content, array $placeholders): string
    {
        // Vérifier si les données valides
        if (!isset($placeholders['purchase']) || !($placeholders['purchase'] instanceof Purchase)) {
            return $content;
        }

        $purchase = $placeholders['purchase'];

        // Remplacer les placeholders spécifiques à l'achat
        if (strpos($content, '[purchase:token]') !== false) {
            $content = str_replace('[purchase:token]', $purchase->token, $content);
        }

        return $content;
    }
}
