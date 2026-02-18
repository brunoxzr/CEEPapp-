<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Página geral de prêmios --}}
    <url>
        <loc>{{ url('/premios-e-reconhecimentos') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Páginas individuais de cada prêmio --}}
    @foreach ($premios as $premio)
        <url>
            <loc>{{ url('/premios-e-reconhecimentos/' . $premio->id) }}</loc>
            <lastmod>{{ optional($premio->updated_at)->toIso8601String() }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach


</urlset>
