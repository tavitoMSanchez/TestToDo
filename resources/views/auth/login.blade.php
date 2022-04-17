 @extends('layouts.app')

 @section('content')
 <div class="container">
 <div class="row">
     <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
         <div class="card border-0 shadow rounded-3 my-5">
             <div class="card-body p-4 p-sm-5">
                 <h5 class="card-title text-center mb-5 fw-light fs-5">Iniciar Sesión blades</h5>
                 <form method="POST" action="{{ route('login') }}">
                 @csrf
                     <div class="form-floating mb-3">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                         @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                         <label for="floatingInput">Correo Electronico</label>
                     </div>
                     <div class="form-floating mb-3">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                         @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                         <label for="floatingPassword">Contraseña</label>
                     </div>
                     <div class="d-grid">
                         <button type="submit" class="btn btn-primary">
                             Iniciar Sesión
                         </button>
                     </div>
                     <hr class="my-4">
                 </form>
             </div>
         </div>
     </div>
 </div>
 </div>
 @endsection

 