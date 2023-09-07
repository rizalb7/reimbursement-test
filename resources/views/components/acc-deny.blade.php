@props(['reimbursement'])

<div class="flex justify-center my-8">
  <form action="{{route('acc', $reimbursement)}}" method="post" >
  @csrf
    <button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-green-500 uppercase align-middle transition-all bg-transparent border border-green-500 rounded-lg cursor-pointer leading-normal text-sm ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">SETUJU</button>
  </form>
  <form action="{{route('deny', $reimbursement)}}" method="post" >
  @csrf
    <button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-red-500 uppercase align-middle transition-all bg-transparent border border-red-500 rounded-lg cursor-pointer leading-normal text-sm ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">TOLAK</button>
  </form>
</div>