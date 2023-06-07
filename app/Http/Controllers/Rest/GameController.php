<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Models\GameHistory;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function play_game(Request $request)
    {
        $current_path = substr($request->personal_link, 1);
        $user = User::query()->where('personal_link', '=', $current_path)->firstOrFail();

        $randomNumber = random_int(1, 1000);
        $result_amount = 0;
        $result_message = 'Lose';

        if ($randomNumber % 2 == 0) {
            switch($randomNumber) {
                case($randomNumber > 900):
                    $result_amount = $randomNumber / 100 * 70;

                break;

                case($randomNumber > 600):
                    $result_amount = $randomNumber / 100 * 50;

                    break;

                case($randomNumber > 300):
                    $result_amount = $randomNumber / 100 * 30;

                    break;

                default:
                    $result_amount = $randomNumber / 100 * 10;
            }

            $result_message = 'Win';
        }

        $history = new GameHistory();

        $history->save([
            $history->user_id = $user->id,
            $history->amount = $result_amount,
            $history->message = $result_message,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => $result_message . ': ' . $result_amount
            ]
        );
    }

    public function last_results(Request $request)
    {
        $current_path = substr($request->personal_link, 1);
        $user = User::query()->where('personal_link', '=', $current_path)->firstOrFail();
        $results = GameHistory::query()->where('user_id', '=', $user->id)->latest()->take(3)->get();

        return $results;
    }
}
