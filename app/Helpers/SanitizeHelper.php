<?php

namespace App\Helpers;

use DOMDocument;
use DOMXPath;

class SanitizeHelper
{
    public static function cleanHtml(string $html): string
    {
        $allowedTags = [
            'a'         => ['class', 'href', 'id', 'rel', 'style', 'target', 'title'],
            'b'         => ['class', 'id', 'style'],
            'blockquote' => ['cite', 'class', 'id', 'style'],
            'br'        => ['class', 'id', 'style'],
            'code'      => ['class', 'id', 'style'],
            'div'       => ['class', 'id', 'style'],
            'em'        => ['class', 'id', 'style'],
            'h1'        => ['class', 'id', 'style'],
            'h2'        => ['class', 'id', 'style'],
            'h3'        => ['class', 'id', 'style'],
            'h4'        => ['class', 'id', 'style'],
            'h5'        => ['class', 'id', 'style'],
            'h6'        => ['class', 'id', 'style'],
            'hr'        => ['class', 'id', 'style'],
            'i'         => ['class', 'id', 'style'],
            'img'       => ['alt', 'class', 'height', 'id', 'loading', 'src', 'style', 'title', 'width'],
            'ins'       => ['class', 'datetime', 'id', 'style'],
            'li'        => ['class', 'data-list', 'id', 'style', 'value'],
            'mark'      => ['class', 'id', 'style'],
            'ol'        => ['class', 'id', 'start', 'style', 'type'],
            'p'         => ['align', 'class', 'id', 'style'],
            'pre'       => ['class', 'id', 'style'],
            's'         => ['class', 'id', 'style'],
            'span'      => ['class', 'id', 'style'],
            'strong'    => ['class', 'id', 'style'],
            'sub'       => ['class', 'id', 'style'],
            'sup'       => ['class', 'id', 'style'],
            'table'     => ['border', 'cellpadding', 'cellspacing', 'class', 'height', 'id', 'style', 'width'],
            'tbody'     => ['class', 'id', 'style'],
            'td'        => ['align', 'class', 'colspan', 'height', 'id', 'rowspan', 'style', 'valign', 'width'],
            'tfoot'     => ['class', 'id', 'style'],
            'th'        => ['align', 'class', 'colspan', 'height', 'id', 'rowspan', 'scope', 'style', 'valign', 'width'],
            'thead'     => ['class', 'id', 'style'],
            'tr'        => ['class', 'id', 'style'],
            'u'         => ['class', 'id', 'style'],
            'ul'        => ['class', 'id', 'style'],
            'area'      => ['class', 'id', 'href', 'alt', 'target', 'shape', 'coords', 'style'],
            'audio'     => ['class', 'id', 'controls', 'autoplay', 'loop', 'muted', 'preload', 'src', 'style'],
            'canvas'    => ['class', 'id', 'width', 'height', 'style'],
            'details'   => ['class', 'id', 'style', 'open'],
            'figcaption' => ['class', 'id', 'style'],
            'figure'    => ['class', 'id', 'style'],
            'iframe'    => ['class', 'id', 'src', 'height', 'width', 'frameborder', 'style'],
            'input'     => ['type', 'class', 'id', 'name', 'value', 'placeholder', 'readonly', 'disabled', 'style', 'maxlength', 'size', 'pattern', 'autocomplete'],
            'label'     => ['class', 'id', 'for', 'style'],
            'link'      => ['rel', 'href', 'type', 'media'],
            'meta'      => ['name', 'content', 'http-equiv', 'charset'],
            'nav'       => ['class', 'id', 'style'],
            'object'    => ['class', 'id', 'data', 'type', 'width', 'height', 'style'],
            'output'    => ['class', 'id', 'for', 'style'],
            'picture'   => ['class', 'id', 'style'],
            'source'    => ['class', 'id', 'src', 'type', 'media'],
            'svg'       => ['class', 'id', 'style', 'width', 'height', 'viewBox', 'xmlns'],
            'video'     => ['class', 'id', 'controls', 'autoplay', 'loop', 'muted', 'preload', 'src', 'width', 'height', 'style'],
        ];

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        // Wrap in a div so fragment parses correctly
        $dom->loadHTML(mb_convert_encoding('<div>' . $html . '</div>', 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $wrapper = $dom->getElementsByTagName('div')->item(0);
        if (! $wrapper) {
            return '';
        }

        // Step 1: collect all nodes (so removals won't break the iterator)
        $nodes = [];
        foreach ($xpath->query('//*') as $node) {
            $nodes[] = $node;
        }

        // Step 2: process each node
        foreach ($nodes as $node) {
            $tag = $node->nodeName;

            // remove disallowed tags entirely
            if (! isset($allowedTags[$tag])) {
                $node->parentNode->removeChild($node);
                continue;
            }

            // clean attributes
            $keep = $allowedTags[$tag];
            if ($node->hasAttributes()) {
                $removeAttrs = [];

                // iterate over a clone of attributes to avoid mutation issues
                foreach (iterator_to_array($node->attributes) as $attr) {
                    $name  = strtolower($attr->nodeName);
                    $value = $attr->nodeValue;

                    // drop if not in whitelist
                    if (! in_array($name, $keep, true)) {
                        $removeAttrs[] = $name;
                        continue;
                    }

                    // sanitize href scheme
                    if ($name === 'href') {
                        $scheme = strtolower(parse_url(trim($value), PHP_URL_SCHEME) ?? '');
                        if (! in_array($scheme, ['http', 'https', 'mailto'], true)) {
                            $removeAttrs[] = $name;
                        }
                    }

                    // sanitize style payload
                    if ($name === 'style') {
                        if (preg_match('/expression|javascript:/i', $value)) {
                            $removeAttrs[] = $name;
                        }
                    }
                }

                // perform removals
                foreach ($removeAttrs as $attrName) {
                    $node->removeAttribute($attrName);
                }
            }
        }

        // Reassemble cleaned HTML
        $clean = '';
        foreach ($wrapper->childNodes as $child) {
            $clean .= $dom->saveHTML($child);
        }

        return $clean;
    }
}
