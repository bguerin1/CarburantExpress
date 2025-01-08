<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdatePreferenceController extends Controller
{
    public function update(Request $request): RedirectResponse{
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update([
            'carburant' => $request->type,
            'position' => $request->position
        ]);

        return back()->with('status', 'dashboard');
    }
}
