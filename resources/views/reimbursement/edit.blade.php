@extends('layout.main')
@section('name', 'Edit Reimbursement')

@section('active-reimbursement')
  @include('layout.partial.active-nav')
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h6 class="dark:text-white text-xl">Edit Reimbursement</h6>
          <div class="max-w-xl">
            <form method="post" action="{{ url('reimbursement/'.$reimbursement->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <x-input-label for="tanggal" :value="__('Tanggal')" />
              <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" :value="old('tanggal', $reimbursement->tanggal)" autocomplete="tanggal" />
              <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
            </div>
            <div class="mb-4">
              <x-input-label for="nama" :value="__('Nama Reimbursement')" />
              <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $reimbursement->nama)" autocomplete="nama" />
              <x-input-error class="mt-2" :messages="$errors->get('nama')" />
            </div>  
            <div class="mb-4">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="" class="focus:shadow-primary-outline min-h-unset text-sm leading-5.6 ease block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">{{$reimbursement->deskripsi}}</textarea>
              <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
            </div>  
            <div class="mb-4">
              <x-input-label for="file" :value="__('File Pendukung')" />
              <x-text-input id="file" name="file[]" type="file" multiple class="mt-1 block w-full" autocomplete="file" />
              @error('file.*')
                <span class="text-sm text-red-600 space-y-1"><strong>{{$message}}</strong></span><br>
              @enderror
            </div>  
            @if ($reimbursement->file)
            <div class="p-2">
                <div class="ml-1">
                    <h6>File Tersimpan <small class="text-red-600">(note: upload file ulang akan mereplace seluruh file tersimpan)</small></h6>
                </div>
                <div class="flex my-1">
                    @foreach (json_decode($reimbursement->file) as $key=>$value)
                    @if (substr(json_decode($reimbursement->file)[$key], -3) == "pdf")
                      <a href="/storage/file-reimbursement/{{$reimbursement->tanggal . "/" . json_decode($reimbursement->file)[$key]}}"><img src="/storage/icon/pdf.png" style="height: 150px; width:150px;" alt="..."></a>
                    @else
                      <img src="/storage/file-reimbursement/{{$reimbursement->tanggal . "/" . json_decode($reimbursement->file)[$key]}}" style="height: 150px; width:150px;" alt="...">
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            <div class="flex items-center gap-4">
              <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
            </form>
          </div>
      </div>
    </div>
    </div>
@endsection