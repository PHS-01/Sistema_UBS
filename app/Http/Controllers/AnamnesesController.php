<?php

namespace App\Http\Controllers;

use App\Models\Anamneses;
use App\Models\Scheduling;
use Illuminate\Http\Request;

class AnamnesesController extends Controller
{
    public function index()
    {
        return Anamneses::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Busca o agendamento pelo ID
        $scheduling = Scheduling::find($id);

        // Verifica se o agendamento existe
        if (!$scheduling) {
            return redirect()->back()->withErrors(['error' => 'Agemtamento nõa encotrado']);
        }

        // Atualiza o status do agendamento
        $scheduling->update([
            'status' => 'In Progress',
        ]);

        // Retorna a view com o ID passado
        return view('anamnese.create', ['id' => $id]);
}

    public function store(Request $request)
    {
        $anamnese = Anamneses::create([
            'schedulings_id' => $request->schedulings_id,
            'chief_complaint' => $request->chief_complaint,
            'medical_history' => $request->medical_history,
            'family_history' => $request->family_history,
            'lifestyle_habits' => $request->lifestyle_habits,
            'symptoms' => $request->symptoms,
        ]);

        $anamnese->scheduling->update([
            'status' => 'Completed',
        ]);
        

        return redirect('/dashboard')->with('success', 'Anamnese criado com sucesso!');
    }

    public function show(Anamneses $anamnese)
    {
        return ;
    }

    public function update(Anamneses $anamnese)
    {
        

        return $medicalHistory;
    }

    public function destroy(Anamneses $anamnese)
    {
        $anamnese->delete();

        return redirect('/dashboard')->with('success', 'Anamnese deletada com sucesso!');
    }
}