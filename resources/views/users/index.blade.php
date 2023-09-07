@extends('layout.main')
@section('name', 'Users Management')

@section('active-users')
  @include('layout.partial.active-nav')
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        <div class="flex p-6 justify-between">
          <h6 class="dark:text-white text-xl">Users Management</h6>
          <a class="inline-block px-6 py-3 mx-6 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md" href="{{url('/users/create')}}">Tambah User</a>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2 mb-6">
          <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-8 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">NIP</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jabatan</th>
                  <th class="px-6 py-3 font-semibold text-left uppercase align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $item)
                  <tr>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <p class="px-6 mb-0 text-sm font-semibold leading-tight">{{$item->nip}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <p class="px-2 mb-0 text-sm font-semibold leading-tight">{{Str::ucfirst($item->name)}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <p class="px-2 mb-0 text-sm font-semibold leading-tight uppercase">{{$item->roles()->first()->name}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <a href="{{url('users/'.$item->id.'/edit')}}" class="text-sm font-semibold leading-tight text-slate-400 hover:text-green-600"> Edit </a>
                      <form action="{{ url('users/' . $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ini?')">
                        @method('delete')
                        @csrf
                        <button class="text-sm font-semibold leading-tight text-slate-400 hover:text-red-700">
                          Hapus 
                        </button>
                    </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection