<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_path',
        'hero_path',
        'author',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'published_at' => 'datetime',
    ];

    public static function sanitizeHtml(?string $html): string
    {
        $html = $html ?? '';
        $html = strip_tags($html, '<p><br><strong><b><em><i><u><s><blockquote><ol><ul><li><h1><h2><h3><h4><h5><h6><a><img><pre><code><span><sub><sup><iframe>');
        $html = preg_replace('/\s+on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        $html = preg_replace_callback('/\s+style\s*=\s*("([^"]*)"|\'([^\']*)\'|([^\s>]+))/i', function ($matches) {
            $style = $matches[2] ?? $matches[3] ?? $matches[4] ?? '';
            $allowed = [];

            foreach (explode(';', $style) as $rule) {
                if (! str_contains($rule, ':')) {
                    continue;
                }

                [$property, $value] = array_map('trim', explode(':', $rule, 2));
                $property = strtolower($property);

                if (! in_array($property, ['color', 'background-color'], true)) {
                    continue;
                }

                if (preg_match('/(?:expression|javascript:|url\s*\()/i', $value)) {
                    continue;
                }

                if (preg_match('/^(#[0-9a-f]{3,8}|rgb\(\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}\s*\)|rgba\(\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*(0|1|0?\.\d+)\s*\)|[a-z]+)$/i', $value)) {
                    $allowed[] = $property . ': ' . $value;
                }
            }

            return $allowed ? ' style="' . implode('; ', $allowed) . '"' : '';
        }, $html);
        $html = preg_replace('/(href|src)\s*=\s*([\'"])\s*javascript:[^\'"]*\2/i', '$1="#"', $html);
        $html = preg_replace('/\s+(href|src)\s*=\s*([\'"])\s*data:[^\'"]*\2/i', '', $html);
        $html = preg_replace('/<img\b(?![^>]*\bsrc=)[^>]*>/i', '', $html);
        $html = preg_replace('/<img\b(?![^>]*\bsrc=([\'"])[^\'"]*\/storage\/[^\'"]*\1)[^>]*>/i', '', $html);
        $html = preg_replace('/<iframe\b(?![^>]*\bsrc=([\'"])https:\/\/(?:www\.)?(?:youtube\.com\/embed\/|player\.vimeo\.com\/video\/)[^\'"]*\1)[\s\S]*?<\/iframe>/i', '', $html);

        return $html ?? '';
    }

    public function getSafeContentAttribute(): string
    {
        return self::sanitizeHtml($this->content);
    }
}
