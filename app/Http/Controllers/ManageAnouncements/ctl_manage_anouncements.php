<?php

namespace App\Http\Controllers\ManageAnouncements;

use App\Http\Controllers\Controller;
use App\Models\anouncements;
use Illuminate\Http\Request;

class ctl_manage_anouncements extends Controller
{
    public function index()
    {
        $Data_anouncements = anouncements::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = false;

        return view('Backend.ManageData.v_manage_anouncements' , compact('Data_anouncements' , 'CheckUpdate'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
