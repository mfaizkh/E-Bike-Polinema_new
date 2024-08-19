<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sewa;
use App\Models\Ebike;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function centrepoint()
    {
        $centrepoint = Centre_Point::latest()->get();
        return datatables()->of($centrepoint)
        ->addColumn('action','backend.CentrePoint.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }

    public function spot()
    {
        $spot = Sewa::with('user')->with('ebike')->latest()->get();
        return datatables()->of($spot)
        // ->addColumn('action','backend.Spot.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function pengguna()
    {
        $spot = User::where('email', '!=', 'admin@gmail.com')->latest()->get();
        return datatables()->of($spot)
        ->addColumn('action','admin.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function bike()
    {
        $spot = Ebike::latest()->get();
        return datatables()->of($spot)
        ->addColumn('action','admin.action_bike')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}
