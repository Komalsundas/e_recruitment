<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class PanelController extends Controller
{
    public function addPanel(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:panels,email', 'regex:/^.+@.+\..+$/'],
            'panel_contact' => 'required|string',
            'vacancy_id' => 'required|integer',
        ]);

        // Create a panel member
        $panel = Panel::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make('123456789'), // Set default password to "123456789"
            'panel_contact' => $validatedData['panel_contact'],
            'vacancy_id' => $validatedData['vacancy_id'],
        ]);

        // Create a corresponding user record
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make('123456789'), // Set default password
            'is_panel' => 1,
            // You may need to adjust other attributes based on your user model
        ]);

        // Assign the 'panel' role to the user if you're using Laravel Spatie Permission package
        $role = Role::where('name', 'panel')->first();
        $user->assignRole($role);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Panel member added successfully. Default password: 123456789');
    }
}