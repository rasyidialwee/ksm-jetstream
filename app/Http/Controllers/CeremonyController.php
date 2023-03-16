<?php

namespace App\Http\Controllers;

use App\Models\Ceremony;
use App\Http\Requests\StoreCeremonyRequest;
use App\Http\Requests\UpdateCeremonyRequest;
use Inertia\Inertia;

class CeremonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Ceremony/Index');
    }

    public function form()
    {
        return inertia('Ceremony/Form');
    }



    /**
     * Display the specified resource.
     */
    public function show(Ceremony $ceremony)
    {
        //
    }
}
