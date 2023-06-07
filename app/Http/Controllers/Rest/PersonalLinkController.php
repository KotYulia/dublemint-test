<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersonalLinkController extends Controller
{
    public function generate_link(Request $request)
    {
        $current_path = substr($request->personal_link, 1);
        $user = User::query()->where('personal_link', '=', $current_path)->firstOrFail();

        $user->update([
            $user->personal_link = Str::random(15)
        ]);

        $new_personal_link = url('/') . '/' . $user->personal_link;

        return response()->json(
            [
                'success' => true,
                'message' => 'Your new personal link generated: <a href="' . $new_personal_link . '">' . $new_personal_link . '</a>'
            ]
        );
    }

    public function deactivate_link(Request $request)
    {
        $current_path = substr($request->personal_link, 1);
        $user = User::query()->where('personal_link', '=', $current_path)->firstOrFail();
        $current_date = Carbon::now()->toDateTimeString();

        $user->update([
            $user->confirmation = 0,
            $user->link_expires_at = $current_date,
        ]);

        return response()->json(['status' => 200]);
    }
}
