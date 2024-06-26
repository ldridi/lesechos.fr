<?php

interface PlaceholderReplacer
{
    public function replacePlaceholders(string $content, array $placeholders): string;
}