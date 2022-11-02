<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\NumberIdentification;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function validateuser()
    {
        $user = Auth::user();
        ($user->email == 'admin@sthonore.com.co') ? $hiddemenu = 1 : $hiddemenu = 0;
        return $hiddemenu;
    }

    public function validateidentification()
    {
        $validateuser = NumberIdentification::find($_POST['identification_id']);
        $validateusernumber = User::where('identification_number', $_POST['identification_id'])->first();
        if ($validateuser != NULL) {
            if ($validateusernumber != NULL) {
                $response = array('Nombre' => "Already using", 'validated' => 2);
            } else {
                $response = array('Nombre' => $validateuser->nombre, 'validated' => 1);
            }
        } else {
            $response = array('Nombre' => "No exists", 'validated' => 0);
        }
        echo json_encode($response);
        exit;
    }
}