@include('layouts.header', ['title' => 'Acessibilidade | CEEP Assaí'])

<main class="bg-white text-slate-800">
<section class="py-24">
<div class="max-w-4xl mx-auto px-6">

<h1 class="text-4xl font-black text-red-800 mb-10">
Acessibilidade
</h1>

<p class="text-slate-700 leading-relaxed mb-6">
O portal do Centro Estadual de Educação Profissional de Assaí (CEEP Assaí)
tem como compromisso garantir o acesso à informação e aos serviços
digitais de forma inclusiva, respeitando as necessidades de todos os
usuários, independentemente de limitações físicas, sensoriais,
cognitivas ou tecnológicas.
</p>

<p class="text-slate-700 leading-relaxed mb-10">
Esta página descreve as diretrizes, recursos e práticas adotadas
para promover a acessibilidade digital no portal do CEEP Assaí,
em conformidade com as normas e recomendações vigentes.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
1. Compromisso com a acessibilidade
</h2>

<p class="text-slate-600 leading-relaxed mb-8">
O CEEP Assaí busca continuamente aprimorar a experiência de uso
do portal, adotando práticas que favoreçam a inclusão digital
e o acesso equitativo às informações institucionais e educacionais.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
2. Recursos de acessibilidade adotados
</h2>

<p class="text-slate-600 leading-relaxed mb-4">
Entre os recursos e boas práticas implementados no portal, destacam-se:
</p>

<ul class="list-disc pl-6 space-y-2 text-slate-600 mb-8">
<li>Compatibilidade com leitores de tela</li>
<li>Estrutura semântica adequada em HTML</li>
<li>Contraste de cores que favorece a leitura</li>
<li>Navegação possível por teclado</li>
<li>Linguagem clara e objetiva</li>
</ul>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
3. Navegação e usabilidade
</h2>

<p class="text-slate-600 leading-relaxed mb-8">
O portal foi desenvolvido buscando facilitar a navegação,
com organização lógica dos conteúdos, títulos bem definidos
e elementos interativos acessíveis, proporcionando uma
experiência mais intuitiva para todos os usuários.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
4. Conteúdo acessível
</h2>

<p class="text-slate-600 leading-relaxed mb-8">
Os conteúdos disponibilizados no portal são produzidos com
atenção à clareza textual, evitando termos excessivamente
técnicos sempre que possível, além de imagens acompanhadas
de descrições alternativas quando aplicável.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
5. Limitações e melhorias contínuas
</h2>

<p class="text-slate-600 leading-relaxed mb-8">
Apesar dos esforços para garantir acessibilidade plena,
podem existir limitações técnicas ou de conteúdo.
O CEEP Assaí compromete-se a avaliar e corrigir eventuais
barreiras identificadas, promovendo melhorias contínuas.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
6. Comunicação e suporte
</h2>

<p class="text-slate-600 leading-relaxed mb-6">
Caso o usuário encontre dificuldades de acesso ou navegação,
pode entrar em contato com a equipe do CEEP Assaí por meio
dos canais oficiais disponíveis no portal.
</p>

<p class="text-slate-600 leading-relaxed mb-8">
As sugestões e feedbacks são fundamentais para o aprimoramento
contínuo da acessibilidade e da qualidade dos serviços oferecidos.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
7. Base legal
</h2>

<p class="text-slate-600 leading-relaxed mb-8">
Esta política de acessibilidade observa as diretrizes da Lei Brasileira
de Inclusão da Pessoa com Deficiência (Lei nº 13.146/2015) e demais
normas aplicáveis à acessibilidade digital.
</p>

<hr class="my-10">

<h2 class="text-2xl font-bold text-slate-900 mb-4">
8. Atualizações
</h2>

<p class="text-slate-600 leading-relaxed mb-10">
Esta página pode ser atualizada periodicamente para refletir
melhorias técnicas, ajustes legais ou evoluções no portal.
</p>

<p class="text-sm text-slate-400">
Última atualização: {{ date('Y') }}
</p>

</div>
</section>
</main>

@include('layouts.footer')
