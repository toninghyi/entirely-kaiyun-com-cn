<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $domain;
    private string $keyword;

    public function __construct(string $url, string $title, string $description, string $domain, string $keyword)
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = $domain;
        $this->keyword = $keyword;
    }

    public static function createDefault(): self
    {
        return new self(
            'https://www.entirely-kaiyun.com.cn',
            '开云平台 - 官方入口',
            '欢迎访问开云，获取最新资讯与服务。',
            'entirely-kaiyun.com.cn',
            '开云'
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['url'] ?? 'https://www.entirely-kaiyun.com.cn',
            $data['title'] ?? '开云',
            $data['description'] ?? '',
            $data['domain'] ?? 'entirely-kaiyun.com.cn',
            $data['keyword'] ?? '开云'
        );
    }

    public function renderHtml(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $safeDomain = htmlspecialchars($this->domain, ENT_QUOTES, 'UTF-8');
        $safeKeyword = htmlspecialchars($this->keyword, ENT_QUOTES, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$safeUrl}" target="_blank" rel="noopener noreferrer" class="link-card-anchor">
        <span class="link-card-keyword">{$safeKeyword}</span>
        <span class="link-card-title">{$safeTitle}</span>
        <span class="link-card-desc">{$safeDesc}</span>
        <span class="link-card-domain">{$safeDomain}</span>
    </a>
</div>
HTML;
    }

    public function renderWithStyle(): string
    {
        $html = $this->renderHtml();
        $css = <<<CSS
<style>
.link-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 16px;
    margin: 12px 0;
    background: #fafafa;
    transition: box-shadow 0.2s;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}
.link-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.link-card-anchor {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.link-card-keyword {
    font-size: 0.75rem;
    color: #1a73e8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.link-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #202124;
}
.link-card-desc {
    font-size: 0.9rem;
    color: #5f6368;
}
.link-card-domain {
    font-size: 0.8rem;
    color: #80868b;
}
</style>
HTML;
        return $css . "\n" . $html;
    }
}

function renderLinkCard(string $url, string $title, string $description, string $domain, string $keyword): string
{
    $card = new LinkCard($url, $title, $description, $domain, $keyword);
    return $card->renderWithStyle();
}

// 示例数据（开云相关）
$sampleUrl = 'https://www.entirely-kaiyun.com.cn';
$sampleTitle = '开云官方网站';
$sampleDesc = '开云为您提供安全可靠的在线服务，涵盖多种娱乐与资讯。';
$sampleDomain = 'entirely-kaiyun.com.cn';
$sampleKeyword = '开云';

echo renderLinkCard($sampleUrl, $sampleTitle, $sampleDesc, $sampleDomain, $sampleKeyword);