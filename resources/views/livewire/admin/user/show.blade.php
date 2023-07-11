<div>
    <div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            {!! Breadcrumbs::render('benutzerShow', $user) !!}
            <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">{{ __('User Settings') }}</h1>
            <x-ag.errors.errorMessages />
        </div>
        <!-- Left Content -->
        <div class="col-span-full xl:col-auto">
            <x-ag.card.profile-picture image="{{ asset($user->image) }}" :user="$user" :upload="$user->id"
                :name="$user->name" :upload-picture="$uploadPicture" />
            @if ($user->id === auth()->user()->id)
                <x-ag.card.head>
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ __('Change Password') }}</h3>
                    <form wire:submit.prevent="changePassword">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 lg:col-full">
                                <x-ag.forms.label-input type="password" id="password.current_password"
                                    text="Aktuelles Passwort" />
                            </div>
                            <div class="col-span-6 lg:col-full">
                                <x-ag.forms.label-input type="password" id="password.password" text="Neues Passwort" />
                            </div>
                            <div class="col-span-6 lg:col-full">
                                <x-ag.forms.label-input type="password" id="password.password_confirmation"
                                    text="Bestätige das neue Passwort" />
                            </div>
                            <div class="col-span-6 lg:col-full">
                                <x-ag.button.loading-button target="changePassword"
                                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                            </div>
                        </div>
                    </form>
                </x-ag.card.head>
            @endif
            @if (auth()->user()->id !== $user->id || auth()->user()->roles[0]->name === 'super_admin')
                @hasanyrole('super_admin|admin')
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ __('Roles') }}</h3>
                        <form wire:submit.prevent="userRoles">
                            <input type="hidden" wire:model="user.id">
                            <div class="grid grid-cols-6 gap-4">
                                <div class="col-span-12">
                                    <x-ag.forms.label id="roles" :text="__('Roles')" />
                                    @foreach ($roles as $role)
                                        <div class="flex items-center mb-2">
                                            <x-ag.forms.input-checkbox id="role-{{ $role->name }}" wire:model="roleCheck"
                                                value="{{ $role->name }}" :text="__($role->name)" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-span-6 lg:col-full">
                                    <x-ag.button.loading-button target="userRoles"
                                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                                </div>
                            </div>
                        </form>
                    </x-ag.card.head>
                @endhasanyrole
            @endif
        </div>
        <!-- Right Content -->
        <div class="col-span-2">
            <x-ag.card.head>
                <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ __('General information') }}</h3>
                <form wire:submit.prevent="userChange">
                    <div class="grid grid-cols-6 gap-4">
                        <input type="hidden" wire:model="user.id">
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input id="user.name" text="Name" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input type="email" id="user.email" :text="__('E-Mail Address')" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input id="user.strasse" text="Straße" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input id="user.plz" text="Postleitzahl" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input id="user.ort" text="Ort" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input type="tel" id="user.telefon" text="Telefon" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input type="tel" id="user.mobil" text="Mobiltelefon" />
                        </div>
                        <div class="col-span-6 lg:col-span-3">
                            <x-ag.forms.label-input type="date" id="user.geburtstag" text="Geburtstag" />
                        </div>
                        <div class="col-span-6 lg:col-full">
                            <x-ag.button.loading-button target="userChange"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
                </form>
            </x-ag.card.head>
            @if ($user->id === auth()->user()->id)
                <x-ag.card.head>
                    <section class="space-y-6">
                        <header>
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ __('Delete Account') }}</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>

                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                            {{ __('Delete Account') }}</x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                    <x-text-input id="password" name="password" type="password"
                                        class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Delete Account') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </x-ag.card.head>
            @endif
        </div>
        @push('scripts')
            @include('livewire.delete')
        @endpush
    </div>
</div>
