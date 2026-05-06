<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $news->title }}</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="
    background:#ffffff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,0.08);
">

    <!-- HEADER -->
    <tr>
        <td style="background:#7f1d1d;padding:20px;text-align:center">
            <img src="https://seudominio.com/img/logo_ceep.jpeg"
                 alt="CEEP Assaí"
                 style="max-height:70px">
        </td>
    </tr>

    <!-- CONTEÚDO -->
    <tr>
        <td style="padding:30px;color:#111827">
            <h2 style="margin-top:0;color:#7f1d1d">
                {{ $news->title }}
            </h2>

            <p style="font-size:15px;color:#374151;line-height:1.6">
                {{ $news->excerpt }}
            </p>

            <a href="{{ route('portal.news.show', $news->slug) }}"
               style="
                   display:inline-block;
                   margin-top:20px;
                   padding:12px 20px;
                   background:#7f1d1d;
                   color:#ffffff;
                   text-decoration:none;
                   border-radius:6px;
                   font-size:14px;
               ">
                Ler notícia completa
            </a>
        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="background:#f9fafb;padding:20px;text-align:center;font-size:12px;color:#6b7280">
            <strong>CEEP Assaí</strong><br>
            Comunicado institucional automático<br>
            Não responda este e-mail
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $news->title }}</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="
    background:#ffffff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,0.08);
">

    <!-- HEADER -->
    <tr>
        <td style="background:#7f1d1d;padding:20px;text-align:center">
            <img src="https://ceepapp-production.up.railway.app/img/logo_ceep.jpeg"
                 alt="CEEP Assaí"
                 style="max-height:70px">
        </td>
    </tr>

    <!-- CONTEÚDO -->
    <tr>
        <td style="padding:30px;color:#111827">
            <h2 style="margin-top:0;color:#7f1d1d">
                {{ $news->title }}
            </h2>

            <p style="font-size:15px;color:#374151;line-height:1.6">
                {{ $news->excerpt }}
            </p>

            <a href="{{ route('portal.news.show', $news->slug) }}"
               style="
                   display:inline-block;
                   margin-top:20px;
                   padding:12px 20px;
                   background:#7f1d1d;
                   color:#ffffff;
                   text-decoration:none;
                   border-radius:6px;
                   font-size:14px;
               ">
                Ler notícia completa
            </a>
        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="background:#f9fafb;padding:20px;text-align:center;font-size:12px;color:#6b7280">
            <strong>CEEP Assaí</strong><br>
            Comunicado institucional automático<br>
            Não responda este e-mail
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
