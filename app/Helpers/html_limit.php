<?php

if (!function_exists('html_limit')) {
    function html_limit($html, $limit = 200)
    {
        $printedLength = 0;
        $position = 0;
        $tags = [];
        $result = '';

        // Regex: match HTML-tags eller tekst
        $re = '/(<[^>]+>|[^<]+)/';

        preg_match_all($re, $html, $tokens);

        foreach ($tokens[0] as $token) {
            if ($token[0] === '<') {
                // Er det et slut-tag?
                if ($token[1] === '/') {
                    $tag = array_pop($tags);
                    $result .= $token;
                } else {
                    // Er det et self-closing tag?
                    if (preg_match('/<(\w+)[^>]*\/>/', $token)) {
                        $result .= $token;
                    } else {
                        preg_match('/<(\w+)/', $token, $tagName);
                        $tags[] = $tagName[1];
                        $result .= $token;
                    }
                }
            } else {
                // Tekst
                $remaining = $limit - $printedLength;
                if (mb_strlen($token) > $remaining) {
                    $result .= mb_substr($token, 0, $remaining) . '...';
                    $printedLength = $limit;
                    break;
                } else {
                    $result .= $token;
                    $printedLength += mb_strlen($token);
                }
            }
        }

        // Luk alle åbne tags
        while (!empty($tags)) {
            $result .= sprintf('</%s>', array_pop($tags));
        }

        return $result;
    }
}
