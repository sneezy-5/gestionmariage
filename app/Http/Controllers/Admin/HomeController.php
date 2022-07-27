<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;


class HomeController extends Controller
{
    public function index(){
        $employes = Employee::count();
        return view('admin.dashboard',compact('employes'));
    }

}