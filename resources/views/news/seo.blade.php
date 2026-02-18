@isset($news)

@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "__HEADLINE__",
  "datePublished": "__DATE_PUBLISHED__",
  "dateModified": "__DATE_MODIFIED__",
  "author": {
    "@type": "Organization",
    "name": "CEEP Assaí"
  },
  "publisher": {
    "@type": "Organization",
    "name": "CEEP Assaí",
    "logo": {
      "@type": "ImageObject",
      "url": "https://ceepassai.com.br/img/logo.png"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "__URL__"
  }
}
</script>
@endverbatim

<script>
  document.currentScript.previousElementSibling.textContent =
    document.currentScript.previousElementSibling.textContent
      .replace("__HEADLINE__", @json($news->title))
      .replace("__DATE_PUBLISHED__", "{{ $news->published_at?->toIso8601String() }}")
      .replace("__DATE_MODIFIED__", "{{ $news->updated_at?->toIso8601String() }}")
      .replace("__URL__", "{{ request()->url() }}");
</script>

<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ request()->url() }}">

<meta name="news_keywords"
      content="CEEP Assaí, educação profissional, ensino técnico, Paraná, escola estadual">

<meta name="description"
      content="{{ $news->excerpt ?? Str::limit(strip_tags($news->content), 160) }}">

<meta property="og:type" content="article">
<meta property="og:title" content="{{ $news->title }}">
<meta property="og:description"
      content="{{ $news->excerpt ?? Str::limit(strip_tags($news->content), 160) }}">
<meta property="og:url" content="{{ request()->url() }}">

<meta property="article:published_time"
      content="{{ $news->published_at?->toIso8601String() }}">
<meta property="article:author"
      content="{{ $news->author ?? 'CEEP Assaí' }}">

@endisset
