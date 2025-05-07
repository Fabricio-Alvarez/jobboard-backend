<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    // Crear una nueva oferta
    public function create(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'category' => 'required|string|max:255',
        ]);

        // Crear la oferta de trabajo
        $jobOffer = JobOffer::create([
            'job_title' => $validated['job_title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'salary' => $validated['salary'],
            'category' => $validated['category'],
            'user_id' => Auth::id(), // Asocia la oferta con el usuario autenticado
        ]);

        return response()->json([
            'message' => 'Oferta de trabajo creada con éxito',
            'job_offer' => $jobOffer,
        ], 201);
    }

    // Listar las ofertas laborales del usuario autenticado
    public function index(Request $request)
    {
        // Obtener las ofertas de trabajo del usuario autenticado
        $jobOffers = JobOffer::where('user_id', Auth::id())->get();
        
        return response()->json($jobOffers);
    }
}
