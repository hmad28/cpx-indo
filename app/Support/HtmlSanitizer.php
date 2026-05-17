<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'a',
        'blockquote',
        'br',
        'code',
        'em',
        'h1',
        'h2',
        'h3',
        'li',
        'ol',
        'p',
        'pre',
        's',
        'span',
        'strong',
        'u',
        'ul',
    ];

    private const ALLOWED_ATTRIBUTES = [
        'a' => ['href', 'target', 'rel'],
    ];

    private const DROP_WITH_CONTENT = ['script', 'style', 'iframe', 'object', 'embed', 'form'];

    public static function clean(?string $html): string
    {
        if (blank($html)) {
            return '';
        }

        $document = new DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML(
            '<div>'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NONET
        );
        libxml_clear_errors();

        $root = $document->documentElement;
        self::sanitizeChildren($root);

        $clean = '';
        foreach ($root->childNodes as $child) {
            $clean .= $document->saveHTML($child);
        }

        return trim($clean);
    }

    private static function sanitizeChildren(DOMNode $node): void
    {
        for ($i = $node->childNodes->length - 1; $i >= 0; $i--) {
            $child = $node->childNodes->item($i);

            if (! $child instanceof DOMElement) {
                continue;
            }

            $tagName = strtolower($child->tagName);

            if (in_array($tagName, self::DROP_WITH_CONTENT, true)) {
                $node->removeChild($child);

                continue;
            }

            self::sanitizeChildren($child);

            if (! in_array($tagName, self::ALLOWED_TAGS, true)) {
                self::unwrapNode($child);

                continue;
            }

            self::sanitizeAttributes($child, $tagName);
        }
    }

    private static function sanitizeAttributes(DOMElement $element, string $tagName): void
    {
        $allowedAttributes = self::ALLOWED_ATTRIBUTES[$tagName] ?? [];

        for ($i = $element->attributes->length - 1; $i >= 0; $i--) {
            $attribute = $element->attributes->item($i);
            $name = strtolower($attribute->name);

            if (! in_array($name, $allowedAttributes, true)) {
                $element->removeAttribute($attribute->name);

                continue;
            }

            if ($name === 'href' && ! self::isSafeUrl($attribute->value)) {
                $element->removeAttribute($attribute->name);
            }
        }

        if ($tagName === 'a' && $element->hasAttribute('href')) {
            $element->setAttribute('rel', 'noopener noreferrer');
            $element->setAttribute('target', '_blank');
        }
    }

    private static function isSafeUrl(string $url): bool
    {
        $scheme = parse_url(trim($url), PHP_URL_SCHEME);

        return $scheme === null || in_array(strtolower($scheme), ['http', 'https', 'mailto', 'tel'], true);
    }

    private static function unwrapNode(DOMElement $element): void
    {
        $parent = $element->parentNode;

        while ($element->firstChild) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
    }
}
