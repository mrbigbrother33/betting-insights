<?php

if (!function_exists('html_limit')) {
    function html_limit(string $html, int $limit = 200): string
    {
        $printed = 0;
        $openTags = [];
        $out = '';

        // Match enten en tag "<...>" eller tekst
        preg_match_all('/(<[^>]+>|[^<]+)/u', $html, $tokens);

        foreach ($tokens[0] as $token) {
            // TAG
            if (isset($token[0]) && $token[0] === '<') {
                // slut-tag
                if (isset($token[1]) && $token[1] === '/') {
                    // luk seneste åbne tag (basic stack)
                    array_pop($openTags);
                    $out .= $token;
                    continue;
                }

                // self-closing?
                if (preg_match('/<\s*([a-z0-9]+)([^>]*)\/\s*>/i', $token)) {
                    $out .= $token;
                    continue;
                }

                // åbningstag -> push navn på stack
                if (preg_match('/<\s*([a-z0-9]+)\b/i', $token, $m)) {
                    $openTags[] = $m[1];
                }
                $out .= $token;
                continue;
            }

            // TEKST: dekod HTML entities -> arbejde i rigtige tegn
            $decoded = html_entity_decode($token, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $remaining = $limit - $printed;
            $len = mb_strlen($decoded, 'UTF-8');

            if ($len > $remaining) {
                // skær på rigtige tegn, ikke midt i &entity;
                $out .= mb_substr($decoded, 0, $remaining, 'UTF-8') . '…';
                $printed = $limit;
                break;
            }

            $out .= $decoded;
            $printed += $len;

            if ($printed >= $limit) {
                $out .= '…';
                break;
            }
        }

        // Luk alle åbne tags i omvendt rækkefølge
        while (!empty($openTags)) {
            $out .= sprintf('</%s>', array_pop($openTags));
        }

        return $out;
    }
}
