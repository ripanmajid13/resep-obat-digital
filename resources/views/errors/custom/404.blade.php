<x-layouts.backend.app>
    <x-pages.backend.card>
            <x-pages.backend.card-slot>
                <div class="error-page">
                    <h2 class="headline text-warning"> 404</h2>

                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                        <p>
                            We could not find the page you were looking for.
                            Meanwhile, you may return to dashboard in the button below or <a href="javascript:window.history.back();">return to the previous page</a>.
                        </p>

                        <x-pages.backend.anchor-xs :class="__('btn-primary')">
                            <x-slot name="url">{{ url('/dashboard') }}</x-slot>
                            <i class="nav-icon fas fa-tachometer-alt"></i> {{ __('Dashboard') }}
                        </x-pages.backend.anchor-xs>
                    </div>
                </div>
            </x-pages.backend.card-slot>
        </div>
    </x-pages.backend.card>
</x-layouts.backend.app>
