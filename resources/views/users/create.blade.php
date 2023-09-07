@extends('layout.main')
@section('name', 'Tambah User')

@section('active-users')
  @include('layout.partial.active-nav')
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
  <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <h6 class="dark:text-white text-xl">Tambah User</h6>
      <div class="max-w-xl">
        <form method="post" action="{{ url('users') }}" class="mt-6 space-y-6">
        @csrf
        <div class="mb-4">
          <x-input-label for="nip" :value="__('NIP')" />
          <x-text-input id="nip" name="nip" type="number" class="mt-1 block w-full" :value="old('nip')" autofocus autocomplete="nip" />
          <x-input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>
        <div class="mb-4">
          <x-input-label for="name" :value="__('Nama')" />
          <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="mb-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" autocomplete="email" />
          <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div class="mb-4">
          <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Jabatan</label>
          <select name="jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected disabled>Pilih Jabatan</option>
            @foreach ($roles as $item)
              <option value="{{$item->name}}">{{Str::upper($item->name)}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
          <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
        </form>
      </div>
  </div>
</div>
</div>
@endsection