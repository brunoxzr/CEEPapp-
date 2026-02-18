<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Atividade Corrigida</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
style="background:#ffffff;border-radius:10px;overflow:hidden;">

<tr>
<td style="background:#7f1d1d;padding:20px;text-align:center">
<img src="https://ceepassai.com.br/img/logo_ceep.jpeg"
alt="CEEP Assaí"
style="max-height:70px">
</td>
</tr>

<tr>
<td style="padding:30px;color:#111827">

<h2 style="color:#7f1d1d;margin-top:0">
Atividade Corrigida
</h2>

<p>
Olá <strong>{{ $aluno->nome }}</strong>,
</p>

<p>
Sua atividade <strong>{{ $atividade->titulo }}</strong> foi corrigida.
</p>

<p>
<strong>Status:</strong> {{ ucfirst($registro->status) }} <br>
<strong>Nota:</strong> {{ $registro->nota ?? '—' }}
</p>

@if($registro->feedback)
<p>
<strong>Feedback do professor:</strong><br>
{{ $registro->feedback }}
</p>
@endif

<br>

<a href="https://ceepassai.com.br/area-academica"
target="_blank"
style="
display:inline-block;
background:#7f1d1d;
color:#ffffff;
padding:14px 28px;
font-size:15px;
font-weight:bold;
text-decoration:none;
border-radius:8px;
">
📚 Ver no sistema
</a>

</td>
</tr>

<tr>
<td style="background:#f9fafb;padding:20px;text-align:center;
font-size:12px;color:#6b7280">
<strong>Centro Estadual de Educação Profissional</strong><br>
CEEP Assaí<br><br>
Este é um comunicado automático do sistema.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
