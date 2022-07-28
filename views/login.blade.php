@extends("layout")
@section("title")
    Log in
@endsection
@section("content")
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            @if(!Auth\Authentication::isAuthorized())
            <form class="box" method="POST" class="login" id="ajax-form">
            @csrf
                <div class="field">
                    <label for="login">Login</label>
                    <div class="control has-icons-left has-icons-right">
                     <input class="input" name="login" id="login" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <p class="help is-danger" id="login_error"></p>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="password" id="password" type="password" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                    </div>
                    <p class="help is-danger" id="password_error"></p>
                </div>
                <input type="submit" class="button is-success" value="Submit">
            </form>
            @else
                <div class="notification is-danger">
                    <p>You are already logged in.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('script')
    <script src="/static/main.js"></script>
@endsection
