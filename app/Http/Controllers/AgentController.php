<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Attendance;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
 
class AgentController extends Controller
{
    public function index(){
        $agents = Agent::all();
        return view('agents.index', compact('agents'));

        // Générer un QR code pour chaque agent
        foreach ($agents as $agent) {
            $agent->qr_code = QrCode::size(100)->generate($agent->qrcode);
        }

        return view('agents.index', compact('agents'));
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Générer un code unique pour le QR code
        $validatedData['qrcode'] = uniqid('agent_');

        // Créer et enregistrer l'agent
        $agent = Agent::create($validatedData);

        // Générer le QR code et l'enregistrer si nécessaire
        // $filePath = storage_path('app/public/qrcodes/' . $agent->id . '.png');
        // QrCode::format('png')->size(300)->generate($agent->qrcode, $filePath);

        return redirect()->route('agents.index')->with('success', 'Agent créé avec succès');
    }

    public function show($id){
        $agent = Agent::findOrFail($id); // Trouve si l'agent est bel et bien dans la base de données
        return view('agents.show', compact('agent'));
    }

    public function edit($id)
    {
        // Trouver l'agent par son ID ou renvoyer une erreur 404 si l'agent n'existe pas
        $agent = Agent::findOrFail($id);

        // Retourner la vue d'édition avec l'agent
        return view('agents.edit', compact('agent'));
    }
    
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Trouver l'agent par ID et mettre à jour ses données
        $agent = Agent::findOrFail($id);
        $agent->update($validatedData);

        // Rediriger vers la liste des agents avec un message de succès
        return redirect()->route('agents.index')->with('success', 'Agent mis à jour avec succès');
    }

    // AgentController.php


    public function scanQr(Request $request)
    {
        $request->validate([
            'qrcode' => 'required|string',
        ]);
    
        $qrcode = $request->input('qrcode');
        $agent = Agent::where('qrcode', $qrcode)->first();
    
        if (!$agent) {
            return response()->json(['message' => 'Agent non trouvé'], 404);
        }
    
        // Enregistrez l'heure d'arrivée ou de départ
        $now = now();
        $attendance = Attendance::where('agent_id', $agent->id)
                                 ->where('date', $now->toDateString())
                                 ->first();
    
        if ($attendance) {
            // Mettre à jour l'heure de départ si l'heure d'arrivée est déjà définie
            if (!$attendance->time_out) {
                $attendance->time_out = $now;
            }
        } else {
            // Créer une nouvelle entrée pour l'heure d'arrivée
            $attendance = Attendance::create([
                'agent_id' => $agent->id,
                'date' => $now->toDateString(),
                'time_in' => $now,
                'time_out' => null
            ]);
        }
    
        $attendance->save();
    
        return response()->json(['message' => 'Enregistrement mis à jour avec succès']);
    }
    
}
