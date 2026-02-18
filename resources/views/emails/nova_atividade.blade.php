<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Nova Atividade</title>
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
📚 Nova Atividade Disponível
</h2>

<p style="font-size:15px;line-height:1.6;color:#374151">
<strong>{{ $atividade->titulo }}</strong>
</p>

@if($atividade->descricao)
<p style="font-size:15px;color:#374151">
{!! nl2br(e($atividade->descricao)) !!}
</p>
@endif

<p style="margin-top:20px;font-size:14px;color:#6b7280">
Turma: <strong>{{ $atividade->turma }}</strong>
</p>

@if($atividade->data_limite)
<p style="font-size:14px;color:#6b7280">
Entrega até:
<strong>
{{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y') }}
</strong>
</p>
@endif

</td>
</tr>

<tr>
<td align="center" style="padding:30px 0">

<a href="https://ceepassai.com.br/area-academica"
   target="_blank"
   style="
       display:inline-block;
       background:#7f1d1d;
       color:#ffffff;
       padding:16px 32px;
       font-size:16px;
       font-weight:bold;
       text-decoration:none;
       border-radius:8px;
   ">
    📚 Acessar Atividade
</a>

</td>
</tr>

<tr>
<td style="background:#f9fafb;padding:20px;text-align:center;
           font-size:12px;color:#6b7280">
<strong>Centro Estadual de Educação Profissional</strong><br>
CEEP Assaí<br><br>
Este é um aviso automático do sistema acadêmico.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
