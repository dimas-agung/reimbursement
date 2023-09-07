<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReimbursementController extends Controller
{
    private $title = 'Seksi';
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 123;
        
        // $reimbursement = Reimbursement::factory()->create();
        // $reimbursement->pushStatus(1);
        // return $reimbursement;
        $reimbursements = Reimbursement::orderBy('doc_no')->get();
        return response()->view('pages.reimbursement.index', [
            'title' => $this->title,
            'reimbursements' => $reimbursements

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('pages.reimbursement.create', [
            'title' => $this->title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required'],
            'name' => ['required'],
            'attachment' => ['sometimes', 'nullable'],
            'description' => ['sometimes', 'nullable'],
        ]);
        $last_nomor = Reimbursement::LastNomor();
        $kode_doc = Reimbursement::KODE_DOC;
        $doc_no = GenerateDocNO($last_nomor+1,$kode_doc);

        $file_attachment = $request->file('attachment');
        $attachment=null;
        if ($file_attachment) {
            $path = 'attachment';
            $extension = $file_attachment->getClientOriginalExtension();
            $file_attachment->storePubliclyAs($path, $doc_no . '.'.$extension, "public");
            $attachment = $path . '/' . $doc_no . '.'.$extension;
        }
        
        $reimbursement = Reimbursement::create([
            'date' => $request->input('date'),
            'name' => $request->input('name'),
            'nomor' => $last_nomor+1,
            'doc_no' => $doc_no,
            'attachment' => $attachment,
            'user_created' => Auth::user()->id,
            'description' => $request->input('description'),
        ]);
        
        return redirect('reimbursement')->with('success', 'Data Reimbursement has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reimbursement $reimbursement)
    {
        return response()->view('pages.reimbursement.show', [
            'title' => $this->title,
            'reimbursement' => $reimbursement
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reimbursement $reimbursement)
    {
        //
        return response()->view('pages.reimbursement.edit', [
            'title' => $this->title,
            'reimbursement' => $reimbursement
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reimbursement $reimbursement)
    {
        //
        $validated = $request->validate([
            'name' => ['required'],
            'attachment' => ['sometimes', 'nullable'],
            'description' => ['sometimes', 'nullable'],
        ]);
        $reimbursement->update($validated);
        $file_attachment = $request->file('attachment');
        if ($file_attachment) {
            $path = 'attachment';
            $extension = $file_attachment->getClientOriginalExtension();
            $file_attachment->storePubliclyAs($path, $reimbursement->doc_no . '.'.$extension, "public");
            $attachment = $path . '/' . $reimbursement->doc_no . '.'.$extension;
            $reimbursement->update(['attachment' => $attachment]);
        }
        return redirect('reimbursement')->with('success', 'Data Reimbursement has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reimbursement $reimbursement)
    {
        //
        $reimbursement->delete();
        return redirect('reimbursement')->with('success', 'Data Reimbursement has been deleted!');
    }
    public function approved(Reimbursement $reimbursement)
    {
        $status = Reimbursement::APPROVE;
        $reimbursement->pushStatus($status);
        return redirect('reimbursement')->with('success', 'Data Reimbursement has been approved!');
    }
    public function rejected( Reimbursement $reimbursement)
    {
        $status = Reimbursement::REJECT;
        $reimbursement->pushStatus($status);
        return redirect('reimbursement')->with('success', 'Data Reimbursement has been rejected!');
    }

}