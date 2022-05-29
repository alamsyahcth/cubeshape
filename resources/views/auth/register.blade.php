@extends('auth.layouts.app') 

@section('content')
<section>
	<div class="d-flex flex-wrap align-items-stretch">
		<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
			<div class="p-4 m-3">
				<img src="{{ asset('img/logo-01.svg') }}" alt="logo" width="80" class="my-3">

				<form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
					@csrf
					<div class="form-group">
						<label for="name">{{ __('Name') }}</label>
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label for="email">{{ __('Email Address') }}</label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label for="password">{{ __('Password') }}</label>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label for="password-confirm">{{ __('Confirm Password') }}</label>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>

					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
							Register
						</button>
					</div>

					<div class="mt-2 text-center">
						have an account? <a href="/login">Login Now !</a>
					</div>
				</form>
				
			</div>
		</div>

		<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="https://images.unsplash.com/photo-1510797215324-95aa89f43c33?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2535&q=80">
			<div class="absolute-bottom-left index-2">
				<div class="text-light p-5 pb-2">
					<div class="mb-5 pb-3">
						<h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
						<h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
					</div>
					Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
