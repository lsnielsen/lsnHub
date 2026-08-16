<?php
/**
 * Global Nyhedsoversigt - NewsService
 * Håndterer hentning, parsing af RSS/Atom-feeds, caching og filtrering.
 */

/**
 * Global Nyhedsoversigt - NewsService
 */

// Fallback polyfills hvis mbstring extension ikke er aktiveret i din php.ini
if (!function_exists('mb_strlen')) {
    function mb_strlen($str, $encoding = 'UTF-8') {
        return strlen($str ?? '');
    }
}
if (!function_exists('mb_substr')) {
    function mb_substr($str, $start, $length = null, $encoding = 'UTF-8') {
        return $length === null ? substr($str ?? '', $start) : substr($str ?? '', $start, $length);
    }
}
if (!function_exists('mb_strtolower')) {
    function mb_strtolower($str, $encoding = 'UTF-8') {
        return strtolower($str ?? '');
    }
}
if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack, $needle, $offset = 0, $encoding = 'UTF-8') {
        return strpos($haystack ?? '', $needle ?? '', $offset);
    }
}


class NewsService {
    private array $feeds;
    private string $cacheDir;
    private int $cacheTtlSeconds;

    public function __construct(array $feeds, string $cacheDir = __DIR__ . '/../cache', int $cacheTtlSeconds = 180) {
        $this->feeds = $feeds;
        $this->cacheDir = rtrim($cacheDir, '/');
        $this->cacheTtlSeconds = $cacheTtlSeconds;

        if (!is_dir($this->cacheDir)) {
            @mkdir($this->cacheDir, 0777, true);
        }
    }

    private array $countryRules = [
        ['name' => 'Ukraine', 'code' => 'UA', 'flag' => '🇺🇦', 'pattern' => '/\b(ukraine|ukrain|kyiv|kiev|zelensky|zelenskyj)\b/iu'],
        ['name' => 'Danmark', 'code' => 'DK', 'flag' => '🇩🇰', 'pattern' => '/\b(danmark|dansk|danske|københavn|copenhagen|regeringen|folketinget)\b/iu'],
        ['name' => 'USA', 'code' => 'US', 'flag' => '🇺🇸', 'pattern' => '/\b(usa|united states|amerika|american|biden|trump|washington|pentagon|white house)\b/iu'],
        ['name' => 'Tyskland', 'code' => 'DE', 'flag' => '🇩🇪', 'pattern' => '/\b(tyskland|germany|deutschland|berlin|scholz|bundestag)\b/iu'],
        ['name' => 'Sverige', 'code' => 'SE', 'flag' => '🇸🇪', 'pattern' => '/\b(sverige|sweden|svensk|stockholm|kristersson|riksdagen)\b/iu'],
        ['name' => 'Norge', 'code' => 'NO', 'flag' => '🇳🇴', 'pattern' => '/\b(norge|norway|norsk|oslo|stortinget)\b/iu'],
        ['name' => 'Frankrig', 'code' => 'FR', 'flag' => '🇫🇷', 'pattern' => '/\b(frankrig|france|fransk|paris|macron)\b/iu'],
        ['name' => 'Storbritannien', 'code' => 'GB', 'flag' => '🇬🇧', 'pattern' => '/\b(storbritannien|britain|uk|england|london|starmer|sunak)\b/iu'],
        ['name' => 'Rusland', 'code' => 'RU', 'flag' => '🇷🇺', 'pattern' => '/\b(rusland|russia|russisk|moskva|putin|kreml)\b/iu'],
        ['name' => 'Mellemøsten & Gaza', 'code' => 'IL', 'flag' => '🇮🇱', 'pattern' => '/\b(israel|gaza|palæstina|palestine|hamas|netanyahu|beirut|libanon|iran|teheran)\b/iu'],
        ['name' => 'Kina', 'code' => 'CN', 'flag' => '🇨🇳', 'pattern' => '/\b(kina|china|kinesisk|beijing|xi jinping|taiwan)\b/iu'],
        ['name' => 'Spanien', 'code' => 'ES', 'flag' => '🇪🇸', 'pattern' => '/\b(spanien|spain|madrid|sánchez|barcelona)\b/iu'],
        ['name' => 'Italien', 'code' => 'IT', 'flag' => '🇮🇹', 'pattern' => '/\b(italien|italy|rom|meloni)\b/iu'],
        ['name' => 'Grønland', 'code' => 'GL', 'flag' => '🇬🇱', 'pattern' => '/\b(grønland|greenland|nuuk|inuit)\b/iu'],
        ['name' => 'Brasilien', 'code' => 'BR', 'flag' => '🇧🇷', 'pattern' => '/\b(brasilien|brazil|lula|brasilia)\b/iu'],
    ];

    public function detectCountries(string $title, string $summary, array $source): array {
        $detected = [];
        $text = $title . ' ' . $summary;

        foreach ($this->countryRules as $rule) {
            if (preg_match($rule['pattern'], $text)) {
                $detected[$rule['name']] = [
                    'name' => $rule['name'],
                    'code' => $rule['code'],
                    'flag' => $rule['flag']
                ];
            }
        }

        if (empty($detected) && !empty($source['country'])) {
            $detected[$source['country']] = [
                'name' => $source['country'],
                'code' => $source['country_code'] ?? 'INT',
                'flag' => $source['flag'] ?? '🌐'
            ];
        }

        return array_values($detected);
    }

    public function getArticles(array $filters = []): array {
        $allArticles = [];

        foreach ($this->feeds as $feedConfig) {
            $articles = $this->fetchFeed($feedConfig);
            if (!empty($articles)) {
                $allArticles = array_merge($allArticles, $articles);
            }
        }

        // Sorter efter udgivelsesdato (nyeste først)
        usort($allArticles, function ($a, $b) {
            $tA = strtotime($a['pub_date'] ?? 'now');
            $tB = strtotime($b['pub_date'] ?? 'now');
            return $tB - $tA;
        });

        // Filtrering
        $filtered = array_filter($allArticles, function ($art) use ($filters) {
            if (!empty($filters['region']) && $filters['region'] !== 'all' && $art['region'] !== $filters['region']) {
                return false;
            }
            if (!empty($filters['language']) && $filters['language'] !== 'all' && $art['language'] !== $filters['language']) {
                return false;
            }
            if (!empty($filters['category']) && $filters['category'] !== 'all' && $art['category'] !== $filters['category']) {
                return false;
            }
            if (!empty($filters['country']) && $filters['country'] !== 'all') {
                $countryFilter = mb_strtolower(trim($filters['country']));
                $matchesCountry = (mb_strtolower($art['country']) === $countryFilter);
                if (!$matchesCountry && !empty($art['detected_countries'])) {
                    foreach ($art['detected_countries'] as $dc) {
                        if (mb_strtolower($dc['name']) === $countryFilter) {
                            $matchesCountry = true;
                            break;
                        }
                    }
                }
                if (!$matchesCountry) return false;
            }
            if (!empty($filters['search'])) {
                $q = mb_strtolower(trim($filters['search']));
                $inTitle = mb_strpos(mb_strtolower($art['title']), $q) !== false;
                $inSummary = mb_strpos(mb_strtolower($art['summary']), $q) !== false;
                $inSource = mb_strpos(mb_strtolower($art['source_name']), $q) !== false;
                $inCountry = mb_strpos(mb_strtolower($art['country']), $q) !== false;
                if (!$inTitle && !$inSummary && !$inSource && !$inCountry) {
                    return false;
                }
            }
            return true;
        });

        $limit = isset($filters['limit']) ? (int)$filters['limit'] : 60;
        return array_slice($filtered, 0, $limit);
    }

    private function fetchFeed(array $source): array {
        $cacheFile = $this->cacheDir . '/feed_' . md5($source['feed_url']) . '.json';

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $this->cacheTtlSeconds)) {
            $data = json_decode(file_get_contents($cacheFile), true);
            if (is_array($data)) {
                return $data;
            }
        }

        $xmlString = $this->fetchUrl($source['feed_url']);
        if (!$xmlString) {
            // Hvis live kald fejler, prøv at hente fra cache selvom den er forældet
            if (file_exists($cacheFile)) {
                return json_decode(file_get_contents($cacheFile), true) ?: [];
            }
            return [];
        }

        $articles = $this->parseXml($xmlString, $source);

        if (!empty($articles)) {
            @file_put_contents($cacheFile, json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        return $articles;
    }

    private function fetchUrl(string $url): ?string {
        if (!function_exists('curl_init')) {
            $ctx = stream_context_create([
                'http' => [
                    'timeout' => 5,
                    'user_agent' => 'GlobalNewsPHP/1.0 (Mozilla/5.0)'
                ]
            ]);
            return @file_get_contents($url, false, $ctx) ?: null;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 GlobalNewsReader/1.0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300 && $result) {
            return $result;
        }
        return null;
    }

    private function parseXml(string $xmlContent, array $source): array {
        $articles = [];

        // Håndter XML namespaces
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA);

        if (!$xml) {
            libxml_clear_errors();
            return [];
        }

        // Standard RSS 2.0
        if (isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                $articles[] = $this->formatItem($item, $source);
            }
        }
        // Atom feed
        elseif (isset($xml->entry)) {
            foreach ($xml->entry as $item) {
                $articles[] = $this->formatAtomItem($item, $source);
            }
        }

        return array_slice($articles, 0, 15);
    }

    private function formatItem(SimpleXMLElement $item, array $source): array {
        $title = $this->cleanText((string)$item->title);
        $desc = (string)$item->description;
        
        // Tjek for content:encoded
        $namespaces = $item->getNamespaces(true);
        if (isset($namespaces['content'])) {
            $contentNs = $item->children($namespaces['content']);
            if (isset($contentNs->encoded)) {
                $desc = (string)$contentNs->encoded;
            }
        }

        $summary = $this->cleanText($desc);
        if (mb_strlen($summary) > 280) {
            $summary = mb_substr($summary, 0, 275) . '...';
        }

        $link = (string)$item->link;
        if (empty($link) && isset($item->guid)) {
            $guid = (string)$item->guid;
            if (filter_var($guid, FILTER_VALIDATE_URL)) {
                $link = $guid;
            }
        }
        if (empty($link)) {
            $link = $source['url'];
        }

        $pubDate = (string)$item->pubDate;
        $timestamp = !empty($pubDate) ? strtotime($pubDate) : time();
        if (!$timestamp) $timestamp = time();

        $imageUrl = null;
        if (isset($item->enclosure) && isset($item->enclosure['url'])) {
            $imageUrl = (string)$item->enclosure['url'];
        } elseif (isset($namespaces['media'])) {
            $media = $item->children($namespaces['media']);
            if (isset($media->content) && isset($media->content->attributes()->url)) {
                $imageUrl = (string)$media->content->attributes()->url;
            } elseif (isset($media->thumbnail) && isset($media->thumbnail->attributes()->url)) {
                $imageUrl = (string)$media->thumbnail->attributes()->url;
            }
        }

        return [
            'id' => md5($link . $title),
            'title' => $title,
            'summary' => !empty($summary) ? $summary : 'Klik for at læse den fulde artikel hos ' . $source['name'] . '.',
            'link' => $link,
            'source_id' => $source['id'],
            'source_name' => $source['name'],
            'country' => $source['country'],
            'country_code' => $source['country_code'],
            'flag' => $source['flag'],
            'region' => $source['region'],
            'language' => $source['language'],
            'language_name' => $source['language_name'],
            'category' => $source['category'],
            'detected_countries' => $this->detectCountries($title, $summary, $source),
            'pub_date' => date('c', $timestamp),
            'formatted_time' => $this->formatRelativeDanishTime($timestamp),
            'image_url' => $imageUrl
        ];
    }

    private function formatAtomItem(SimpleXMLElement $entry, array $source): array {
        $title = $this->cleanText((string)$entry->title);
        $summary = $this->cleanText((string)($entry->summary ?: $entry->content ?: ''));
        if (mb_strlen($summary) > 280) {
            $summary = mb_substr($summary, 0, 275) . '...';
        }

        $link = $source['url'];
        if (isset($entry->link)) {
            foreach ($entry->link as $l) {
                if ((string)$l['rel'] === 'alternate' || empty($l['rel'])) {
                    $link = (string)$l['href'];
                    break;
                }
            }
        }

        $pubDate = (string)($entry->published ?: $entry->updated ?: 'now');
        $timestamp = strtotime($pubDate) ?: time();

        return [
            'id' => md5($link . $title),
            'title' => $title,
            'summary' => !empty($summary) ? $summary : 'Læs hele nyheden hos kilden.',
            'link' => $link,
            'source_id' => $source['id'],
            'source_name' => $source['name'],
            'country' => $source['country'],
            'country_code' => $source['country_code'],
            'flag' => $source['flag'],
            'region' => $source['region'],
            'language' => $source['language'],
            'language_name' => $source['language_name'],
            'category' => $source['category'],
            'detected_countries' => $this->detectCountries($title, $summary, $source),
            'pub_date' => date('c', $timestamp),
            'formatted_time' => $this->formatRelativeDanishTime($timestamp),
            'image_url' => null
        ];
    }

    private function cleanText(string $text): string {
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return trim(preg_replace('/\s+/', ' ', $text));
    }

    private function formatRelativeDanishTime(int $timestamp): string {
        $diff = time() - $timestamp;
        if ($diff < 120) return 'Lige nu';
        if ($diff < 3600) return 'For ' . floor($diff / 60) . ' min. siden';
        if ($diff < 86400) {
            $h = floor($diff / 3600);
            return $h == 1 ? 'For 1 time siden' : 'For ' . $h . ' timer siden';
        }
        if ($diff < 172800) return 'I går kl. ' . date('H:i', $timestamp);
        return date('j. M Y, H:i', $timestamp);
    }
}
