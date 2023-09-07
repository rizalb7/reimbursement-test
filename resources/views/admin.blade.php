@extends('layout.main')
@section('name', 'Dashboard')

@section('active-dashboard')
  @include('layout.partial.active-nav')
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <!-- table 1 -->

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="p-4 mt-8 text-xl text-center font-bold uppercase dark:text-white">Selamat Datang {{auth()->user()->name}}</h6>
          <h6 class="p-4 mb-8 text-md text-center font-semibold uppercase dark:text-white">({{auth()->user()->roles->first()->name}})</h6>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection