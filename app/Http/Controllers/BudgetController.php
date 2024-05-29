<?php

namespace App\Http\Controllers;
use App\Models\CrmProject;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index(Request $request){
        $projects = CrmProject::where('user_rep_id', $request->user()->id)->get();
        return Inertia('Budget', ['projects' => $projects->all()]);
    }
}
