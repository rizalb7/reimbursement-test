<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $userRole =$user->roles->first()->name;
        if ($userRole == 'staff') {
            $data = Reimbursement::where('user_id', $user->id)->orderBy('tanggal', 'DESC')->orderBy('created_at', 'DESC')->get();
        } else if ($userRole == 'finance') {
            $data = Reimbursement::whereNot('status', 'on_hold')->WhereNot('status', 'deny_by_dir')->orderBy('tanggal', 'DESC')->orderBy('created_at', 'DESC')->get();
        } else {
            $data = Reimbursement::orderBy('tanggal', 'DESC')->orderBy('created_at', 'DESC')->get();
        }
        
        return view('reimbursement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reimbursement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'file.*'=>'nullable|mimes:jpeg,jpg,png,pdf',
        ]);
        
        $data = [
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => 'on_hold',
            'user_id' => auth()->user()->id
        ];
        
        if($request->hasfile('file')) {
           foreach($request->file('file') as $file)
           {
               $name = time() . '-' . $file->getClientOriginalName();
               $file->storeAs('public/file-reimbursement/' . $request->tanggal, $name);
               $imgData[] = $name;
               $data['file'] = json_encode($imgData);  
           }
        }
        Reimbursement::create($data);
        return redirect('reimbursement');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reimbursement $reimbursement)
    {
        return view('reimbursement.show', compact('reimbursement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reimbursement $reimbursement)
    {
        return view('reimbursement.edit', compact('reimbursement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reimbursement $reimbursement)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'file.*'=>'nullable|mimes:jpeg,jpg,png,pdf',
        ]);
        
        $data = [
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ];

        $file = json_decode($reimbursement->file);
        
        if ($request->tanggal != $reimbursement->tanggal) {
            foreach ($file as $item) {
                Storage::disk('public')->move('file-reimbursement/'.$reimbursement->tanggal.'/'. $item, 'file-reimbursement/'.$request->tanggal.'/'. $item);
            }
        }
        
        if($request->hasfile('file')) {
            if ($reimbursement->file) {
                foreach ($file as $item) {
                    File::delete('storage/file-reimbursement/'.$reimbursement->tanggal.'/'. $item);
                }
            }
           foreach($request->file('file') as $file)
           {
               $name = time() . '-' . $file->getClientOriginalName();
               $file->storeAs('public/file-reimbursement/' . $request->tanggal, $name);
               $imgData[] = $name;
               $data['file'] = json_encode($imgData);  
           }
        }
        $reimbursement->update($data);
        return redirect('reimbursement');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reimbursement $reimbursement)
    {
        $reimbursement->delete();
        return redirect('reimbursement');
    }

    /**
     * Acc the reimbursement.
     */
    public function acc(Reimbursement $reimbursement)
    {
        return $this->acc_deny($reimbursement, 'acc');
    }

    /**
     * Deny the reimbursement.
     */
    public function deny(Reimbursement $reimbursement)
    {
        return $this->acc_deny($reimbursement, 'deny');
    }

    private function acc_deny($reimbursement, $status) {
        $user = auth()->user();
        $userRole =$user->roles->first()->name;
        $data = [];
        if ($userRole == 'finance') {
            $data['status'] = $status . '_by_fin';
        } else {
            $data['status'] = $status . '_by_dir';
        }
        $reimbursement->update($data);
        return redirect('reimbursement');
    }
}
