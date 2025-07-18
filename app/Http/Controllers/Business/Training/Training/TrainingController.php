<?php

namespace App\Http\Controllers\Business\Training\Training;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    // List all trainings
    public function index()
    {
        $trainings = Training::all();

        return view('app.business.training.training.training_index', compact('trainings'));
    }

    // Show form to create
    public function create()
    {
        return view('app.business.training.training.training_create');
    }

    // Store new training
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Training::create($data);

        return redirect()->route('training.index')
            ->with('success', 'Training criado.');
    }

    public function show($id)
    {
        $training = Training::where('id', $id)->firstOrFail();

        return view('app.business.training.training.training_show', compact('training'));
    }

    public function edit($id)
    {
        $training = Training::where('id', $id)->firstOrFail();

        return view('app.business.training.training.training_edit', compact('training'));
    }

    // Update existing training
    public function update(Request $request, Training $training)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $training->update($data);

        return redirect()->route('training.index')
            ->with('success', 'Training atualizado.');
    }

    // Delete a training
    public function destroy($id)
    {
        $training = Training::where('id', $id)->firstOrFail();

        $training->delete();

        return redirect()->route('training.index')->with('success', 'Training removido.');
    }
}
