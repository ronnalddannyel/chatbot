<x-layout-auth>
    @slot('title','Register')
        
    <div class="app app-auth-sign-up align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="index.html">Chat Auto - Automatização do Whatsapp</a>
            </div>
            @if (session()->has('alert'))
            <x-alert>
                @slot('type',session('alert')['type'])
                @slot('msg',session('alert')['msg'])
            </x-alert>
         @endif
            <p class="auth-description">Por favor, insira suas credenciais para criar uma conta.<br>Já tens uma conta? <a href="{{route('login')}}">Entrar</a></p>
           <p class="auth-description">Está com dúvidas ou problemas? <a href="http://wa.me/558881889548">SUPORTE WHATSAPP</a></p>

            <div class="auth-credentials m-b-xxl">
                <form action="" class="" method="post">
                    @csrf
                    
                   
<div class="mb-2">

    <label for="username" class="form-label">Usuário</label>
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}"  id="email" aria-describedby="email" placeholder="Nome de Usuário">
    @error('username')
    <div class="form-text text-danger">{{$message}}</div>
    @enderror   
</div>

                      
                  
<div class="mb-2">

    <label for="email" class="form-label">E-mail</label>
    <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"  id="email" aria-describedby="email" placeholder="Exemplo@gmail.com">
    @error('email')
    <div class="form-text text-danger">{{$message}}</div>
    @enderror   
</div>

    
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" id="password" aria-describedby="signUpPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    @error('password')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
               @enderror
              
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">Registrar-se</button>
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