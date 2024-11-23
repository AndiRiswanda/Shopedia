<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-purple-800 leading-tight">
            {{ __('Profile Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-purple-50 to-purple-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Picture Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300">
                <div class="p-6 bg-purple-50 border-b border-purple-100">
                    <h3 class="text-xl font-bold text-purple-800 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Profile Picture
                    </h3>
                </div>
                <div class="p-6">
                    <form method="post" action="{{ route('profile.update-picture') }}" class="max-w-2xl mx-auto p-6 space-y-8">
                        @csrf
                        @method('patch')
                        
                        <div class="flex flex-col md:flex-row md:items-center gap-8">
                            <!-- Current Profile Picture Display -->
                            <div class="flex flex-col items-center space-y-3">
                                <div class="relative group">
                                    <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-purple-400 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                                    <img src="{{ asset($user->profile_url) }}"
                                         alt="{{ auth()->user()->name }}'s profile picture"
                                         class="relative h-32 w-32 rounded-full object-cover border-4 border-white shadow-lg">
                                </div>
                                <span class="text-sm text-gray-600 font-medium">Current Picture</span>
                            </div>
                    
                            <!-- Profile Picture Options -->
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Select Profile Picture</h3>
                                <div class="grid grid-cols-3 md:grid-cols-5 gap-6" x-data="{ selected: '{{ $user->profile_url }}' }">
                                    @php
                                        $profilePics = [
                                            'images/DefaultProfilePic/Shopedia Profile-01-01.png',
                                            'images/DefaultProfilePic/Shopedia Profile-02-01.png',
                                            'images/DefaultProfilePic/Shopedia Profile-03-01.png',
                                            'images/DefaultProfilePic/Shopedia Profile-04-01.png',
                                            'images/DefaultProfilePic/Shopedia Profile-05-01.png',
                                        ];
                                    @endphp
                                    
                                    @foreach ($profilePics as $pic)
                                        <label class="cursor-pointer relative group">
                                            <input type="radio" 
                                                   name="profile_picture" 
                                                   value="{{ $pic }}"
                                                   x-on:click="selected = '{{ $pic }}'"
                                                   {{ Str::contains($user->profile_url, $pic) ? 'checked' : '' }}
                                                   class="peer hidden">
                                            <div class="relative">
                                                <!-- Decorative ring animation -->
                                                <div class="absolute -inset-0.5 bg-purple-500 rounded-full opacity-0 transition-opacity duration-300"
                                                     :class="selected === '{{ $pic }}' ? 'opacity-20' : 'group-hover:opacity-10'"></div>
                                                
                                                <!-- Profile image -->
                                                <img src="{{ asset($pic) }}"
                                                     alt="Profile option"
                                                     class="relative w-20 h-20 rounded-full object-cover transition-all duration-300"
                                                     :class="selected === '{{ $pic }}' ? 
                                                         'ring-4 ring-purple-500 ring-offset-2 scale-105' : 
                                                         'ring-2 ring-gray-200 group-hover:ring-purple-300'">
                                                
                                                <!-- Selection indicator -->
                                                <div class="absolute bottom-0 right-0 transform translate-x-1/4 translate-y-1/4"
                                                     :class="selected === '{{ $pic }}' ? 'block' : 'hidden'">
                                                    <div class="bg-purple-500 text-white rounded-full p-1 shadow-lg">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    
                        <!-- Save Button and Status Message -->
                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200">
                                {{ __('Save Changes') }}
                            </button>
                    
                            @if (session('status') === 'profile-picture-updated')
                                <p x-data="{ show: true }"
                                   x-show="show"
                                   x-transition
                                   x-init="setTimeout(() => show = false, 2000)"
                                   class="text-sm text-green-600 font-medium">
                                    {{ __('Changes saved successfully') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <!-- Profile Information Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300">
                <div class="p-6 bg-purple-50 border-b border-purple-100">
                    <h3 class="text-xl font-bold text-purple-800 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Update Profile Information
                    </h3>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300">
                <div class="p-6 bg-purple-50 border-b border-purple-100">
                    <h3 class="text-xl font-bold text-purple-800 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Update Password
                    </h3>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300">
                <div class="p-6 bg-red-50 border-b border-red-100">
                    <h3 class="text-xl font-bold text-red-800 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete Account
                    </h3>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
