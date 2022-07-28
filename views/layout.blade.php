<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/static/bulma.css" rel="stylesheet" type="text/css">
    <script defer src="/static/font_awesome.js"></script>
    <title>@yield('title')</title>
</head>
<body>
<div class="columns">
    @if (Auth\Authentication::isAuthorized())
        <div class="column is-one-third has-text-centered">
        <span class="tag is-medium is-info is-light">
            <i class="fas fa-user"></i>&emsp;
            Hello, {{ CONSTS['CURRENT_USER_NAME'] }} !
        </span>
        </div>
    @endif
    <div class="column">
        <nav class="breadcrumb is-centered is-medium has-bullet-separator" aria-label="breadcrumbs">
            <ul>
                <li @if ($_SERVER['REQUEST_URI'] == CONSTS['INDEX_URI']) class="is-active" @endif>
                    <a href="@relative('/')">Home</a>
                </li>
                <li @if ($_SERVER['REQUEST_URI'] == CONSTS['ABOUT_URI']) class="is-active" @endif>
                    <a href="@relative('/about')">About</a>
                </li>
                @if (Auth\Authentication::isAuthorized())
                    <li><a href="@relative('/logout')">Sign out</a></li>
                @else
                    <li @if ($_SERVER['REQUEST_URI'] == CONSTS['LOGIN_URI']) class="is-active" @endif>
                        <a href="@relative('/login')">Sign in</a>
                    </li>
                    <li @if ($_SERVER['REQUEST_URI'] == CONSTS['REGISTER_URI']) class="is-active" @endif>
                        <a href="@relative('/register')">Sign up</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@yield('content')
@yield('script')
</body>
</html>