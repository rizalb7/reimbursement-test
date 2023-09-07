@extends('layout.main')
@section('name', 'Lihat Reimbursement')

@section('active-reimbursement')
  @include('layout.partial.active-nav')
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h6 class="dark:text-white text-xl">Lihat Reimbursement</h6>
          <div class="max-w-xl">
            <div class="my-4">
              <x-input-label for="tanggal" :value="__('Tanggal')" />
              <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" :value="old('tanggal', $reimbursement->tanggal)" autocomplete="tanggal" readonly/>
              <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
            </div>
            <div class="mb-4">
              <x-input-label for="nama" :value="__('Nama Reimbursement')" />
              <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $reimbursement->nama)" autocomplete="nama" readonly/>
              <x-input-error class="mt-2" :messages="$errors->get('nama')" />
            </div>  
            <div class="mb-4">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="" class="focus:shadow-primary-outline min-h-unset text-sm leading-5.6 ease block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" readonly>{{$reimbursement->deskripsi}}</textarea>
              <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
            </div>   
            @if ($reimbursement->file)
            <div class="p-2">
                <div class="ml-1">
                    <h6 class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">File Pendukung</h6>
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
            <div class="mb-4">
              <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Status</label>
              <p class="px-2 mb-0 text-sm font-semibold leading-tight uppercase">
                @if ($reimbursement->status == 'acc_by_dir')
                  <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-emerald-500 to-teal-400 align-baseline font-bold uppercase leading-none text-white">disetujui direktur</span>
                @elseif ($reimbursement->status == 'deny_by_dir')
                  <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-red-600 to-orange-600 align-baseline font-bold uppercase leading-none text-white">ditolak direktur</span>
                @elseif ($reimbursement->status == 'acc_by_fin')
                  <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-emerald-500 to-teal-400 align-baseline font-bold uppercase leading-none text-white">disetujui finance</span>
                @elseif ($reimbursement->status == 'deny_by_fin')
                  <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-red-600 to-orange-600 align-baseline font-bold uppercase leading-none text-white">ditolak finance</span>
                @else
                  <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-blue-500 to-violet-500 align-baseline font-bold uppercase leading-none text-white">menunggu persetujuan</span>
                @endif
              </p>
            </div>
            @hasanyrole('direktur|finance')
              @role('direktur')
                @if ($reimbursement->status == 'on_hold')
                  <x-acc-deny :reimbursement=$reimbursement></x-acc-deny>
                @endif
              @endrole
              @role('finance')
                @if ($reimbursement->status == 'acc_by_dir')
                  <x-acc-deny :reimbursement=$reimbursement></x-acc-deny>
                @endif
              @endrole
            @endhasanyrole
          </div>
      </div>
    </div>
    </div>
@endsection