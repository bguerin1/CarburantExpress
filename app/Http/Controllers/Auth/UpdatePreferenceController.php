<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UpdatePreferenceController extends Controller
{
    public function update(Request $request): RedirectResponse{
        $request->validate([
            'type' => ['required', 'int'],
            'position' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update([
            'carburant' => $request->type,
            'position' => $request->position
        ]);

        return redirect()->route('dashboard')->with('success', 'Vos préférences ont été mises à jour !');
    }
}
