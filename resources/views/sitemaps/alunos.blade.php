<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

@foreach ($alunos as $perfil)
    @if(
        $perfil->publico === true &&
        $perfil->aluno &&
        !empty($perfil->aluno->slug)
    )
        <url>
            <loc>{{ url('/perfil/aluno/' . $perfil->aluno->slug) }}</loc>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endif
@endforeach

</urlset>
