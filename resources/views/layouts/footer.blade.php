  </main>

  <footer class="mt-10 bg-slate-900 text-slate-200">
    <div class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-4 gap-8">
      <div>
        <h3 class="font-semibold mb-2">Sobre</h3>
        <p class="text-sm opacity-80">
          Sistema Acadêmico para CEEP & Carrão: boletins, cronograma diário e gestão simplificada.
        </p>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Links</h3>
        <ul class="space-y-1 text-sm">
          <li><a class="hover:underline" href="{{ url('/') }}">Início</a></li>
          <li><a class="hover:underline" href="{{ route('aluno.login') }}">Login Aluno</a></li>
          <li><a class="hover:underline" href="{{ route('admin.login') }}">Login Gestor</a></li>
        </ul>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Ajuda</h3>
        <ul class="space-y-1 text-sm">
          <li>Suporte: suporte@escola.edu.br</li>
          <li>Manual do Usuário (em breve)</li>
          <li>Dúvidas frequentes</li>
        </ul>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Legal</h3>
        <ul class="space-y-1 text-sm">
          <li>Privacidade</li>
          <li>Termos</li>
          <li>Acessibilidade</li>
        </ul>
      </div>
    </div>
    <div class="border-t border-slate-700">
      <div class="max-w-6xl mx-auto px-4 py-4 text-xs opacity-75">
        &copy; {{ date('Y') }} CEEP & Carrão. Todos os direitos reservados.
      </div>
    </div>
  </footer>

  <script>
    // tema claro/escuro (persistência simples)
    const html = document.documentElement;
    const iconSun = document.getElementById('iconSun');
    const iconMoon = document.getElementById('iconMoon');
    const current = localStorage.getItem('theme') || 'light';
    function applyTheme(mode){
      if(mode === 'dark'){ html.classList.add('dark'); iconSun.classList.add('hidden'); iconMoon.classList.remove('hidden'); }
      else { html.classList.remove('dark'); iconMoon.classList.add('hidden'); iconSun.classList.remove('hidden'); }
      localStorage.setItem('theme', mode);
    }
    applyTheme(current);

    document.getElementById('themeToggle')?.addEventListener('click', ()=>{
      const mode = html.classList.contains('dark') ? 'light' : 'dark';
      applyTheme(mode);
    });

    // micro-interações
    document.querySelectorAll('button, a').forEach(el=>{
      el.addEventListener('mousedown', ()=> el.classList.add('tap'));
      el.addEventListener('mouseup', ()=> el.classList.remove('tap'));
      el.addEventListener('mouseleave', ()=> el.classList.remove('tap'));
    });
  </script>
</body>
</html>
