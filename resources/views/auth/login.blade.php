<x-app-layout>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow">Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Login</h3>
                                        </div>
                                        <form method="POST" action="{{route('login')}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required name="email" :value="old('email')" placeholder="Your Email" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input required type="password" name="password" placeholder="Password" autocomplete="current-password">
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="check-form">
                                                    <div class="custom-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                                        <label class="form-check-label" for="remember_me"><span>Remember Me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="{{route('password.request')}}">Forgot Password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log In</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                               <img src="{{asset('img/login.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>