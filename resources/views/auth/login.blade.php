<x-layout-auth>
    @slot('title','Login')
        
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">
    
        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="/">Chat Auto - Whatsapp</a>
            </div>
           @if (session()->has('alert'))
              <x-alert>
                  @slot('type',session('alert')['type'])
                  @slot('msg',session('alert')['msg'])
              </x-alert>
           @endif
            <p class="auth-description">Não tem uma conta? <a href="register">Registrar agora</a></p>
          <p class="auth-description">Está com dúvidas ou problemas? <a href="http://wa.me/558881889548">SUPORTE WHATSAPP</a></p>
          
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="auth-credentials m-b-xxl">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" name="username" class="form-control m-b-md" id="username" aria-describedby="username">
    
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" id="password" aria-describedby="password" >
                </div>
    
                <div class="auth-submit">
                    <button type="submit" name="login" class="btn btn-primary">Entrar</button>
                    {{-- <a href="#" class="auth-forgot-password float-end">Esqueceu a senha?</a> --}}
                </div>
            </form>
            <div class="divider"></div>
            <div class="auth-alts">
                <a href="#" class="auth-alts-google"></a>
                <a href="#" class="auth-alts-facebook"></a>
                <a href="#" class="auth-alts-twitter"></a>
            </div>
        </div>
    </div>
</x-layout-auth>