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

    public function create()
    {
        return inertia('Ceremony/Form');
    }

    public function edit(Ceremony $ceremony)
    {
        return inertia('Ceremony/Form', [
            'ceremony' => $ceremony
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Ceremony $ceremony)
    {
        //
    }
}
