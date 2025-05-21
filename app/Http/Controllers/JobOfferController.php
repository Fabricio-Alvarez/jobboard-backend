<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    /**
     * Crear una nueva oferta de trabajo.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'job_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'salary'      => 'required|numeric',
            'category'    => 'required|string|max:255',
        ]);

        $jobOffer = JobOffer::create([
            'job_title'   => $validated['job_title'],
            'description' => $validated['description'],
            'location'    => $validated['location'],
            'salary'      => $validated['salary'],
            'category'    => $validated['category'],
            'user_id'     => Auth::id(),
        ]);

        return response()->json([
            'message'   => 'Oferta de trabajo creada con éxito',
            'job_offer' => $jobOffer,
        ], 201);
    }

    /**
     * Listar las ofertas laborales del usuario autenticado.
     */
    public function index(Request $request)
    {
        $jobOffers = JobOffer::where('user_id', Auth::id())->get();
        return response()->json($jobOffers);
    }

    /**
     * Actualizar una oferta de trabajo específica si pertenece al reclutador.
     */
    public function update(Request $request, $id)
    {
        // 1) Validar datos
        $validated = $request->validate([
            'job_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'salary'      => 'required|numeric',
            'category'    => 'required|string|max:255',
        ]);

        // 2) Buscar oferta o fallo 404
        $offer = JobOffer::findOrFail($id);

        // 3) Verificar propietario
        if ($offer->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'No tienes permiso para editar esta oferta'
            ], 403);
        }

        // 4) Actualizar
        $offer->update([
            'job_title'   => $validated['job_title'],
            'description' => $validated['description'],
            'location'    => $validated['location'],
            'salary'      => $validated['salary'],
            'category'    => $validated['category'],
        ]);

        return response()->json([
            'message'   => 'Oferta actualizada con éxito',
            'job_offer' => $offer,
        ], 200);
    }

    /**
     * Eliminar una oferta de trabajo específica si pertenece al reclutador.
     */
    public function destroy($id)
    {
        $offer = JobOffer::findOrFail($id);

        if ($offer->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar esta oferta'
            ], 403);
        }

        $offer->delete();

        return response()->json([
            'message' => 'Oferta eliminada con éxito'
        ], 200);
    }
}
