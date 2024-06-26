<?php

class TemplateManager
{
    private $placeholderReplacers;

    public function __construct(array $placeholderReplacers = [])
    {
        $this->placeholderReplacers = $placeholderReplacers;
    }

    public function getTemplateComputed(Template $tpl, array $placeholders)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $placeholders);
        $replaced->content = $this->computeText($replaced->content, $placeholders);

        return $replaced;
    }

    private function computeText($content, array $placeholders)
    {
        foreach ($this->placeholderReplacers as $replacer) {
            $content = $replacer->replacePlaceholders($content, $placeholders);
        }
        return $content;
    }
}
