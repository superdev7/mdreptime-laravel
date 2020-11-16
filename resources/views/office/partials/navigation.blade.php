{{-- Stored in /resources/views/office/partials/navigation.blade.php --}}
{{--[navigation]--}}
<nav class="navbar navbar-expand-lg md-navbar">
    @component('components.elements.link', [
        'href'      => secure_url('office'),
        'classes'   => ['navbar-brand']
    ])
        <span class="site-name">
            @component('components.elements.image', [
                'src'       => asset('images/logo.png'),
                'attrs'     => [
                    'title' => config('app.name')
                ],
                'classes'   => ['logo']
            ])
            @endcomponent
        </span>
    @endcomponent
    {{--[toggler]--}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-frontend-collapse" aria-controls="navbar-frontend-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon fas fa-bars"></i>
    </button>
    {{--[/toggler]--}}
    <div class="collapse navbar-collapse navbar-frontend-collapse" id="navbar-frontend-collapse">
        <div class="d-block w-100">
            <ul class="navbar-nav mr-auto justify-content-end">
                <li class="nav-item">
                    @component('components.elements.link', [
                        'href'      => route('office.calendar.index'),
                        'classes'   => ['nav-link']
                    ])
                        {{ __('Calendar') }}
                    @endcomponent
                </li>
                <li class="nav-item">
                    @component('components.elements.link', [
                        'href'      => '#',
                        'classes'   => ['nav-link']
                    ])
                        {{ __('Messages') }} <span class="badge badge-secondary">0</span>
                    @endcomponent
                </li>
                <li class="nav-item">
                    @component('components.elements.link', [
                        'href'      => '#',
                        'classes'   => ['nav-link']
                    ])
                        {{ __('Rep Database') }}
                    @endcomponent
                </li>
                <li class="nav-item">
                    @component('components.elements.link', [
                        'href'      => route('office.staff.index'),
                        'classes'   => ['nav-link']
                    ])
                        {{ __('Staff') }}
                    @endcomponent
                </li>
                <li class="nav-item">
                    @component('components.elements.link', [
                        'href'      => route('office.settings.edit'),
                        'classes'   => ['nav-link']
                    ])
                        {{ __('Settings') }}
                    @endcomponent
                </li>
                <li class="nav-item">
                    @component('components.forms.form', ['classes' => ['nav-link', 'fg-blue'], 'method' => 'POST', 'action' => route('logout') ])
                        <button type="submit" class="btn-unstyled fg-blue">{{ __('Logout') }} <i class="fas fa-sign-out-alt"></i></button>
                    @endcomponent
                </li>
            </ul>
        </div>
    </div>
</nav>