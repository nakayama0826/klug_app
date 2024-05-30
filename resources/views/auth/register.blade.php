@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; width:21.6px; color:rgb(106, 184, 99)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(106, 184, 99)"></i>
@endsection

@section('second_header')
    <div class="text-center bg-success text-white h4 py-2">
        <i class="fa-solid fa-home" style="font-size: 70%;"></i>
        ユーザー登録
    </div>
@endsection

@section('contents')
    <style>
        div {
            margin-top: 0px !important;
            padding-top: 0px !important;
        }
    </style>

    <x-guest-layout>
        <x-jet-authentication-card>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-jet-label for="name" value="{{ __('名前') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="Department" value="{{ __('所属部署') }}" />
                    <x-jet-input id="Department" class="block mt-1 w-full" type="text" name="Department"
                        :value="old('Department')" required autofocus autocomplete="new-field" />
                </div>

                <div class="mt-4" style="display: flex">
                    <x-jet-input id="AdminAuth" class="block mr-3" type="checkbox" name="AdminAuth" autofocus
                        autocomplete="new-field" />
                    <x-jet-label for="AdminAuth" value="{{ __('管理者権限を付与しますか。') }}" />
                </div>

                <div class="mt-4" style="display: flex">
                    <x-jet-input id="checkAuth" class="block mr-3" type="checkbox" name="checkAuth" autofocus
                        autocomplete="new-field" />
                    <x-jet-label for="checkAuth" value="{{ __('確認権限を付与しますか。') }}" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </x-guest-layout>
@endsection
