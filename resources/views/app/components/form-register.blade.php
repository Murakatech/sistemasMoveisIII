<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Cadastrar Usuário</h3>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{ old('name') }}">
                        <label for="name">Nome</label>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
                        <label for="email">E-mail</label>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                        <label for="password">Senha</label>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha">
                        <label for="password_confirmation">Confirmar Senha</label>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100">Cadastrar</button>
                </form>
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mt-3 text-center">
                    <p class="mb-0">Já tem uma conta? <a href="{{ route('login') }}">Entrar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
