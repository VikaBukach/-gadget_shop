@extends('layouts.auth')

@section('title', 'Відновлення пароля')
@section('content')
    <x-forms.auth-forms
        title="Відновлення пароля"
        action=""
        method="POST"
    >
        @csrf

        <x-forms.text-input
            name="email"
            type="email"
            placeholder="E-mail"
            required="true"
            :isError="$errors->has('email')"
        ></x-forms.text-input>

        @error('email')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password"
            type="password"
            placeholder=Пароль
            required="true"
            :isError="$errors->has('password')"
        ></x-forms.text-input>

        @error('password')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password_confirmation"
            type="password"
            placeholder="Підтвердіть пароль"
            required="true"
            :isError="$errors->has('email')"
        ></x-forms.text-input>

        @error('password_confirmation')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Зберегти пароль
        </x-forms.primary-button>


        <x-slot:buttons></x-slot:buttons>
    </x-forms.auth-forms>
@endsection


