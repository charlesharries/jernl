<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPreferences;

class UserPreferencesController extends Controller
{
    public function update(Request $request) {
        $attributes = $request->validate([
            'use_serif' => 'boolean',
        ]);

        $preferences = auth()->user()->preferences;

        if (! $preferences) {
            $preferences = new UserPreferences(['user_id' => auth()->id()]);
            $preferences->save();
        }

        $smth = $preferences->update($attributes);
        $preferences->refresh();

        return back();
    }
}
