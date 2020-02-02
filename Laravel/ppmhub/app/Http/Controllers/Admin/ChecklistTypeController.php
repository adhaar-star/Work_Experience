<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ChecklistType;

class ChecklistTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklisttype = ChecklistType::all();
        return view('admin.checklisttype.index', compact('checklisttype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.checklisttype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:checklist_type',
        ]);
        
        ChecklistType::create($request->all());
        session()->flash('flash_message', 'Checklist type created successfully...');
        return redirect('admin/checklisttype');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checklisttype = ChecklistType::find($id);
        return view('admin.checklisttype.create', compact('checklisttype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $checklisttype = ChecklistType::find($id);
        $this->validate($request, [
            'name' => 'required',
            /* 'description' => 'required' */
        ]);
        $checklisttype->update($request->all());
        session()->flash('flash_message', 'Checklist type updated successfully...');
        return redirect('admin/checklisttype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checklisttype = ChecklistType::find($id);
        $checklisttype->delete();
        session()->flash('flash_message', 'Checklist type deleted successfully...');
        return redirect('admin/checklisttype');
    }
}
