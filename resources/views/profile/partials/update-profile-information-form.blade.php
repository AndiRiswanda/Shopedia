<section class="bg-white rounded-xl shadow-lg p-8 space-y-6">
    <header class="border-b border-purple-100 pb-4">
        <h2 class="text-2xl font-bold text-purple-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-purple-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-purple-700 font-semibold" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full border-purple-300 focus:border-purple-500 focus:ring focus:ring-purple-200 rounded-lg" 
                :value="old('name', $user->name)" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-purple-700 font-semibold" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full border-purple-300 focus:border-purple-500 focus:ring focus:ring-purple-200 rounded-lg" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="bg-purple-50 p-4 rounded-lg mt-4">
                    <p class="text-sm text-purple-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="ml-2 text-purple-600 hover:text-purple-800 font-semibold transition">
                            {{ __('Re-send verification email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-purple-600 hover:bg-purple-700 focus:ring-purple-500">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Profile Updated Successfully!') }}</p>
            @endif
        </div>
    </form>
</section>