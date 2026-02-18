<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

@foreach($news as $item)
  <url>
    <loc>{{ url('/noticias/'.$item->slug) }}</loc>

    <news:news>
      <news:publication>
        <news:name>CEEP Assaí</news:name>
        <news:language>pt</news:language>
      </news:publication>

      <news:publication_date>{{ $item->published_at->toIso8601String() }}</news:publication_date>
      <news:title><![CDATA[{{ $item->title }}]]></news:title>
    </news:news>
  </url>
@endforeach

</urlset>
