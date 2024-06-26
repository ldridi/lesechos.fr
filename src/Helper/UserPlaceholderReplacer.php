<?php

class UserPlaceholderReplacer implements PlaceholderReplacer
{
    public function replacePlaceholders(string $content, array $placeholders): string
    {
        $APPLICATION_CONTEXT = ApplicationContext::getInstance();

        // Vérifier si les données contiennent un utilisateur valide
        $_user = (isset($placeholders['user']) && $placeholders['user'] instanceof User)
            ? $placeholders['user']
            : $APPLICATION_CONTEXT->getCurrentUser();

        // Remplacer les placeholders spécifiques à l'utilisateur
        if ($_user) {
            if (strpos($content, '[user:first_name]') !== false) {
                $content = str_replace(
                    '[user:first_name]',
                    ucfirst(strtolower($_user->firstname)),
                    $content
                );
            }
        }

        return $content;
    }
}