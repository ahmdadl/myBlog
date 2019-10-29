<div>
    <b-navbar toggleable='lg' type='dark' variant='primary'>
        <b-navbar-brand href='{{ url('/') }}'>
            {{ config('app.name', 'Laravel') }}
        </b-navbar-brand>

        <b-navbar-toggle target='nav-collapse'></b-navbar-toggle>

        <b-collapse id='nav-collapse' is-nav>
            <b-navbar-nav>
                <b-nav-item href='/api/posts'
                    class="{{request()->is('posts') ? 'active' : ''}}">
                    Posts
                </b-nav-item>
                {{-- <b-nav-item href='/posts/create'
                    class="{{request()->is('posts/create') ? 'active' : ''}}">
                    CreatePost
                </b-nav-item>
                <b-nav-item href='/category/create'
                    class="{{request()->is('category/create') ? 'active' : ''}}">
                    Ccategory
                </b-nav-item> --}}
            </b-navbar-nav>

            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right>
                    <template v-slot:button-content>
                        @guest
                        <b-nav-item href="{{ route('login') }}">
                            {{ __('Login') }}
                        </b-nav-item>
                        @if (Route::has('register'))
                        <b-nav-item href="{{ route('register') }}">
                            {{ __('Register') }}
                        </b-nav-item>
                        @endif
                        @else
                        <span class="d-inline mr-1 badge @switch(Auth::user()->type)
                                @case('admin')
                                    {{'badge-danger'}}
                                    @break
                                @case('normal')
                                    {{'badge-primary'}}
                                    @break
                                @case('super')
                                    {{'badge-success'}}
                                @default
                                    {{'badge-primary'}}
                            @endswitch">
                            {{Auth::user()->type}}
                        </span>
                        <img class="img d-inline rounded-circle pr-1"
                            src='{{asset('img/user.png')}}' width="35"
                            height="35">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </template>
                    <b-dropdown-item href="{{ route('logout') }}" v-on:click.stop.prevent='$refs.logForm.submit()'>
                        {{ __('Logout') }}
                    </b-dropdown-item>
                    <form id="logout-form" ref='logForm' action="{{ route('logout') }}"
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endguest
                </b-nav-item-dropdown>
            </b-navbar-nav>

        </b-collapse>


    </b-navbar>
</div>