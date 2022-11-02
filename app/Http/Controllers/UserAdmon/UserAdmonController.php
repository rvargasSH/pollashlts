<?php

namespace App\Http\Controllers\UserAdmon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdmonController extends Controller
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
            $useradmon = User::where('id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $useradmon = User::latest()->paginate($perPage);
        }
        $data = array('useradmon' => $useradmon, 'hiddemenu' => $this->validateuser(),);
        return view('useradmon.user-admon.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = array('hiddemenu' => $this->validateuser());
        return view('useradmon.user-admon.create')->with($data);
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
        $newuser = new User();
        $newuser->name = $requestData['name'];
        $newuser->email = $requestData['email'];
        $newuser->password = bcrypt($requestData['password']);
        $newuser->deparment_id = $requestData['deparment_id'];
        $newuser->first_time = $requestData['first_time'];
        $newuser->save();

        return redirect('UserAdmon/user-admon')->with('flash_message', 'UserAdmon added!');
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
        $useradmon = User::findOrFail($id);
        $data = array('useradmon' => $useradmon, 'hiddemenu' => $this->validateuser(),);
        return view('useradmon.user-admon.show')->with($data);
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
        $useradmon = User::findOrFail($id);
        $data = array('useradmon' => $useradmon, 'hiddemenu' => $this->validateuser(),);
        return view('useradmon.user-admon.edit')->with($data);
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
        $useradmon = User::findOrFail($id);
        $useradmon->name = $request['name'];
        $useradmon->email = $requestData['email'];
        $useradmon->password = bcrypt($requestData['password']);
        $useradmon->deparment_id = $requestData['deparment_id'];
        $useradmon->first_time = $requestData['first_time'];
        $useradmon->save();

        return redirect('UserAdmon/user-admon')->with('flash_message', 'UserAdmon updated!');
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
        User::destroy($id);

        return redirect('UserAdmon/user-admon')->with('flash_message', 'UserAdmon deleted!');
    }
}