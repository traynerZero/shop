@include('header')
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{ url('/login/checkUser') }}" method="post">
							{{ csrf_field() }}
							<input type="email" placeholder="Email Address" name="email" />
							<input type="password" placeholder="Password" name="password"/>
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span> -->
							<button type="submit" class="btn btn-default">Login</button>
						</form>
						@if(session('error'))
						<div class="msg">
							<p style="color:red;">{{ session('error')  }}</p>
						</div>
						@endif
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ url('/login/registerUser') }}" method="post">
						{{ csrf_field() }}
							<input type="email" placeholder="Email Address" name="reg_email"/>
							<input type="password" placeholder="Password" name="reg_pass"/>
							<input type="password" placeholder="Confirm Password" name="reg_cfpass"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
						@if(session('reg_error'))
						<div class="msg">
							<p style="color:red;">{{ session('reg_error')  }}</p>
						</div>
						@endif
						@if(session('reg_success'))
						<div class="msg">
							<p style="color:green;">{{ session('reg_success')  }}</p>
						</div>
						@endif
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
		
		@include('footer')