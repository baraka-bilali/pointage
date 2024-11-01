<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Récupérer tous les rendez-vous
    $appointments = Appointment::all();

    // Récupérer tous les patients pour la liste déroulante
    $patients = Patient::all();

    // Récupérer tous les docteurs pour la liste déroulante
    $doctors = User::where('role', 'doctor')->get();

    return view('appointments.index', compact('appointments', 'patients', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer la liste des patients et des docteurs pour les menus déroulants
        $patients = Patient::all();
        $doctors = User::where('role', 'doctor')->get();

        return view('appointments.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'description' => 'nullable',
        ]);

        // Créer un nouveau rendez-vous
        Appointment::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('appointments.index')->with('success', 'Rendez-vous créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        // Récupérer la liste des patients et des docteurs pour les menus déroulants
        $patients = Patient::all();
        $doctors = User::where('role', 'doctor')->get();

        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Valider les données du formulaire
        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'description' => 'nullable',
        ]);

        // Mettre à jour les informations du rendez-vous
        $appointment->update($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('appointments.index')->with('success', 'Rendez-vous mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        // Supprimer le rendez-vous
        $appointment->delete();

        // Rediriger avec un message de succès
        return redirect()->route('appointments.index')->with('success', 'Rendez-vous supprimé avec succès');
    }
}
