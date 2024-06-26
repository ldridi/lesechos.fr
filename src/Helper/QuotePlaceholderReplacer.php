<?php

class QuotePlaceholderReplacer implements PlaceholderReplacer
{
    public function replacePlaceholders(string $content, array $placeholders): string
    {
        // Vérifier si les données contiennent un devis valide
        if (!isset($placeholders['quote']) || !($placeholders['quote'] instanceof Quote)) {
            return $content;
        }

        $quote = $placeholders['quote'];
        $quoteRepository = QuoteRepository::getInstance();
        $siteRepository = SiteRepository::getInstance();
        $destinationRepository = DestinationRepository::getInstance();

        // Récupérer les informations nécessaires des repositories
        $_quoteFromRepository = $quoteRepository->getById($quote->id);
        $usefulObject = $siteRepository->getById($quote->siteId);
        $destinationOfQuote = $destinationRepository->getById($quote->destinationId);

        if (strpos($content, '[quote:destination_link]') !== false) {
            $destination = $destinationRepository->getById($quote->destinationId);
        }

        if (strpos($content, '[quote:summary_html]') !== false) {
            $content = str_replace(
                '[quote:summary_html]',
                Quote::renderHtml($_quoteFromRepository),
                $content
            );
        }

        if (strpos($content, '[quote:summary]') !== false) {
            $content = str_replace(
                '[quote:summary]',
                Quote::renderText($_quoteFromRepository),
                $content
            );
        }

        if (strpos($content, '[quote:destination_name]') !== false) {
            $content = str_replace(
                '[quote:destination_name]',
                $destinationOfQuote->countryName,
                $content
            );
        }

        if (isset($destination)) {
            $content = str_replace(
                '[quote:destination_link]',
                $usefulObject->url . '/' . $destination->countryName . '/quote/' . $_quoteFromRepository->id,
                $content
            );
        } else {
            $content = str_replace('[quote:destination_link]', '', $content);
        }

        return $content;
    }
}