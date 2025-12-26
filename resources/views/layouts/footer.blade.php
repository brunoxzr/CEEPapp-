<footer class="mt-10 bg-red-800 text-red-100 border-t-4 border-yellow-400">
    <div class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-4 gap-8">

        <!-- Sobre -->
        <div>
            <h3 class="font-bold text-yellow-300 mb-2">Sobre</h3>
            <p class="text-sm opacity-90">
                Sistema Acadêmico do CEEP — boletins digitais, cronograma diário e gestão educacional moderna.
            </p>
        </div>

        <!-- Links -->
        <div>
            <h3 class="font-bold text-yellow-300 mb-2">Navegação</h3>
            <ul class="space-y-1 text-sm">
                <li><a class="hover:text-yellow-300 transition" href="{{ url('/') }}">Início</a></li>
                <li><a class="hover:text-yellow-300 transition" href="{{ route('aluno.login') }}">Login Aluno</a></li>
                <li><a class="hover:text-yellow-300 transition" href="{{ route('admin.login') }}">Login Gestor</a></li>
            </ul>
        </div>

        <!-- Ajuda -->
        <div>
            <h3 class="font-bold text-yellow-300 mb-2">Ajuda</h3>
            <ul class="space-y-1 text-sm">
                <li>Email Suporte: suporte@ceep.edu.br</li>
                <li>Manual do Usuário (em breve)</li>
                <li>Dúvidas Frequentes</li>
            </ul>
        </div>

        <!-- Legal -->
        <div>
            <h3 class="font-bold text-yellow-300 mb-2">Informações</h3>
            <ul class="space-y-1 text-sm">
                <li>Política de Privacidade</li>
                <li>Termos de Uso</li>
                <li>Acessibilidade</li>
            </ul>
        </div>
    </div>

    <!-- Base -->
    <div class="border-t border-red-700">
        <div class="max-w-6xl mx-auto px-4 py-4 text-xs opacity-75">
            &copy; {{ date('Y') }} CEEP — Sistema Acadêmico. Todos os direitos reservados.
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
      if(mode === 'dark'){
        html.classList.add('dark');
        iconSun?.classList.add('hidden');
        iconMoon?.classList.remove('hidden');
      } else {
        html.classList.remove('dark');
        iconMoon?.classList.add('hidden');
        iconSun?.classList.remove('hidden');
      }
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

