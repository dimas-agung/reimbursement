<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private $title = 'Employee';
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $leader;
        $users = User::OrderBy('nip')->get();
        return response()->view('pages.employee.index', [
            'title' => $this->title,
            'employees' => $users
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
        return response()->view('pages.employee.create', []);
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
            'name' => ['required'],
            'nip' => ['required'],
            'email' => ['required'],
            'jabatan' => ['required'],
            'password' => ['required'],
        ]);
        // return $request->input('nip');
        $employee = User::create([
            'nip' => $request->input('nip'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'jabatan' => $request->input('jabatan'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('employee')->with('success', 'Data Employee has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return response()->view('pages.employee.show', [
            'employee' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return response()->view('pages.employee.edit', [
            'employee' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validated = $request->validate([
            'name' => ['required'],
            'nip' => ['required'],
            'email' => ['required'],
            'jabatan' => ['required'],
            'password' => ['required'],
        ]);
        // return $request->input('jabatan');
        $employee = $user->update([
            'name' => $request->input('name'),
            'nip' => $request->input('nip'),
            'email' => $request->input('email'),
            'jabatan' => $request->input('jabatan'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('employee')->with('success', 'Data Employee has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect('employee')->with('success', 'Data Employee has been deleted!');
    }
    //
    
}