<?php

// app/Http/Controllers/AttendanceController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Agent;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Affiche la page de scan QR
    public function showScanPage()
    {
        return view('scan-qr');
    }

    // Gère la soumission du formulaire après le scan QR
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

        $now = now();
        $attendance = Attendance::updateOrCreate(
            [
                'agent_id' => $agent->id,
                'date' => $now->toDateString()
            ],
            [
                'time_in' => $attendance ? $attendance->time_in : $now,
                'time_out' => $attendance ? $attendance->time_out : null
            ]
        );

        return redirect()->route('scan-qr')->with('success', 'Présence enregistrée avec succès');
    }
}
