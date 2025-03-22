<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function home(Request $request){
        return view('admin.home', []);
    }

    public function getStores()
    {
        $users = Store::select(['id', 'name', 'location']);

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($store) {
                return '<a href="users/' . $store->id . '/edit" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
