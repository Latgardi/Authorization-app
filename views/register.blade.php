@extends('layout')

@section('title')
    Register
@endsection

@section('content')

    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            @if(!Auth\Authentication::isAuthorized())
            <form class="box" method="POST" class="register" id="ajax-form">
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
                <div class="field">
                    <label for="confirm">Confirm password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="confirm" id="confirm" type="password" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <p class="help is-danger" id="confirm_error"></p>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="email" id="email" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    <p class="help is-danger" id="email_error"></p>
                </div>
                <div class="field">
                    <label for="name">Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="name" id="name" required>
                        <span class="icon is-small is-left">
                         <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    <p class="help is-danger" id="name_error"></p>
                </div>
                <input type="submit" class="button is-success" value="Submit">
            </form>
            @else
                <div class="notification is-danger">
                    <p>You are already registered.</p>
                </div>
            @endif
        </div>
    </div>


@endsection
@section('script')
    <script src="/static/main.js"></script>
@endsection
