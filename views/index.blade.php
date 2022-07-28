@extends("layout")
@section("title")
    Main Page
@endsection
@section("content")
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="box has-background-primary-light is-light">
                @if(Auth\Authentication::isAuthorized())
                     <p class="has-text-justified">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                @else
                    <h3 class="has-text-centered">Hello!</h3>
                    <p class="has-text-centered">Here you can log in or register.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
