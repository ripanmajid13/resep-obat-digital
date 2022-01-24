<x-layouts.backend.app>
    <x-pages.backend.card>
            <x-pages.backend.card-slot>
                <div class="error-page">
                    <h2 class="headline text-danger"> 403</h2>

                    <div class="error-content">
                        <h3><i class="fas fa-ban text-danger"></i> Forbidden.</h3>

                        <p>
                            The page you were looking for, cannot be accessed.
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
