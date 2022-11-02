<?php

namespace App\Http\Controllers\politicnanager;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PoliticAdmin;
use App\Models\RoundsPolitics;
use App\Models\Round;
use Illuminate\Http\Request;

class PoliticAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $politicadmin = PoliticAdmin::where('politic_name', 'LIKE', "%$keyword%")
                ->orWhere('user_opcion', 'LIKE', "%$keyword%")
                ->orWhere('calcule_script', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $politicadmin = PoliticAdmin::latest()->paginate($perPage);
        }
        $data = array(
            'politicadmin'  => $politicadmin,
            'hiddemenu' => $this->validateuser(),
        );

        return view('politicmanager.politic-admin.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = array(
            'hiddemenu' => $this->validateuser(),
        );

        return view('politicmanager.politic-admin.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        PoliticAdmin::create($requestData);

        return redirect('politicmanager/politic-admin')->with('flash_message', 'PoliticAdmin added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $politicadmin = PoliticAdmin::findOrFail($id);
        $data = array(
            'politicadmin'  => $politicadmin,
            'hiddemenu' => $this->validateuser()

        );
        return view('politicmanager.politic-admin.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $politicadmin = PoliticAdmin::findOrFail($id);
        $data = array(
            'politicadmin'  => $politicadmin,
            'hiddemenu' => $this->validateuser()

        );
        return view('politicmanager.politic-admin.edit')->with($data);
    }
    public function setpoints($idpolitic)
    {
        $politicadmin = PoliticAdmin::findOrFail($idpolitic);
        $rounds = Round::all();
        $data = array(
            'politicadmin'  => $politicadmin,
            'rounds'  => $rounds,
            'hiddemenu' => $this->validateuser()

        );
        return view('politicmanager.politic-admin.setpoints')->with($data);
    }
    public function getpoints()
    {
        $getpoints = RoundsPolitics::where('id_politic', $_POST['politic_id'])->where('id_round', $_POST['round_id'])->where('user_opcion', $_POST['user_opcion'])->first();
        ($getpoints != NULL) ? $points = $getpoints->points : $points = "";
        $response = array('points' => $points, 'message' => "Execute");
        echo json_encode($response);
        exit;
    }
    public function savepoints()
    {
        $validate = RoundsPolitics::where('id_politic', $_POST['politic_id'])->where('id_round', $_POST['round_id'])->where('user_opcion', $_POST['user_opcion'])->first();
        if ($validate != NULL) {
            $rowaffect = RoundsPolitics::findOrFail($validate->id);
            $rowaffect->points = $_POST['points'];
            $rowaffect->save();
        } else {
            $rowaffect = new RoundsPolitics;
            $rowaffect->id_round = $_POST['round_id'];
            $rowaffect->id_politic = $_POST['politic_id'];
            $rowaffect->user_opcion = $_POST['user_opcion'];
            $rowaffect->points = $_POST['points'];
            $rowaffect->save();
        }
        $response = array('message' => "Puntos Actualizados");
        echo json_encode($response);
        exit;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $politicadmin = PoliticAdmin::findOrFail($id);
        $politicadmin->update($requestData);

        return redirect('politicmanager/politic-admin')->with('flash_message', 'PoliticAdmin updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        PoliticAdmin::destroy($id);

        return redirect('politicmanager/politic-admin')->with('flash_message', 'PoliticAdmin deleted!');
    }
}