{{-- Stored in resources/views/office/settings/partials/sidebar.blade.php }} --}}
@component('components.bootstrap.card', [
    'id'    => 'office-settings-sidebar-card'
])
    <div class="card-header">
        <h5>{{ __('Settings') }}</h5>
    </div>
    <div class="card-body p-0 m-0 border-0">
        <ul class="list-group">
            <li class="list-group-item">
                @component('components.elements.link', [
                    'href'  => route('office.settings.edit.general')
                ])
                    {{ __('General') }}
                @endcomponent
            </li>
            <li class="list-group-item">
                @component('components.elements.link', [
                    'href'  => route('office.settings.edit.offices')
                ])
                    {{ __('Offices') }}
                @endcomponent
            </li>
            <li class="list-group-item">
                @component('components.elements.link', [
                    'href'  => route('office.settings.edit.calendar')
                ])
                    {{ __('Calendar') }}
                @endcomponent
            </li>
            <li class="list-group-item">
                @component('components.elements.link', [
                    'href'  => route('office.settings.edit.subscription')
                ])
                    {{ __('Subscription') }}
                @endcomponent
            </li>
        </ul>
    </div>
@endcomponent