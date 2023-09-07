@extends('layout.main')
@section('name', 'Reimbursement')

@section('active-reimbursement')
  @include('layout.partial.active-nav')
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        <div class="flex p-6 justify-between">
          <h6 class="dark:text-white text-xl">Reimbursement</h6>
          @role('staff')
            <a class="inline-block px-6 py-3 mx-6 font-bold text-center text-white uppercase align-middle     transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md" href="{{url('/reimbursement/create')}}">Ajukan Reimbursement</a>
          @endrole
        </div>
        <div class="flex-auto px-0 pt-0 pb-2 mb-6">
          <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-8 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Reimbursement</th>
                  @hasanyrole('direktur|finance')
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Pengguna</th>
                  @endhasanyrole
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                  <th class="px-6 py-3 font-semibold text-left uppercase align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($data->isEmpty())
                    <tr>
                      <td class="text-slate-400" align="center" colspan="5">Tidak ada data</td>
                    </tr>
                @else
                  @foreach ($data as $item)
                    <tr>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="px-6 mb-0 text-sm font-semibold leading-tight">{{date("d-m-Y", strtotime($item->tanggal))}}</p>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="px-2 mb-0 text-sm font-semibold leading-tight">{{Str::ucfirst($item->nama)}}</p>
                      </td>
                      @hasanyrole('direktur|finance')
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="px-2 mb-0 text-sm font-semibold leading-tight">{{Str::ucfirst($item->user->name)}}</p>
                        </td>
                      @endhasanyrole
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="px-2 mb-0 text-sm font-semibold leading-tight uppercase">
                          @if ($item->status == 'acc_by_dir')
                            <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-emerald-500 to-teal-400 align-baseline font-bold uppercase leading-none text-white">disetujui direktur</span>
                          @elseif ($item->status == 'deny_by_dir')
                            <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-red-600 to-orange-600 align-baseline font-bold uppercase leading-none text-white">ditolak direktur</span>
                          @elseif ($item->status == 'acc_by_fin')
                            <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-emerald-500 to-teal-400 align-baseline font-bold uppercase leading-none text-white">disetujui finance</span>
                          @elseif ($item->status == 'deny_by_fin')
                            <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-red-600 to-orange-600 align-baseline font-bold uppercase leading-none text-white">ditolak finance</span>
                          @else
                            <span class="py-1.4 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl from-blue-500 to-violet-500 align-baseline font-bold uppercase leading-none text-white">menunggu persetujuan</span>
                          @endif
                        </p>
                      </td>
                      <td class="p-2 ml-8 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <a href="{{url('reimbursement/'.$item->id)}}" class="text-md font-semibold leading-tight text-slate-400 hover:text-blue-600"> Lihat </a>
                        @role('staff')
                          @if ($item->status == 'on_hold')
                            <a href="{{url('reimbursement/'.$item->id.'/edit')}}" class="text-md font-semibold leading-tight text-slate-400 hover:text-green-600">| Edit </a>
                            <form action="{{ url('reimbursement/' . $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ini?')">
                              @method('delete')
                              @csrf
                              <button class="text-md font-semibold leading-tight text-slate-400 hover:text-red-700">
                                Hapus 
                              </button>
                            </form>
                          @endif
                        @endrole
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection