<?php

namespace App\Http\Controllers\Gigi;

use Auth;
use App\GigyProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GigiController extends Controller
{
    public function index(){
        $gigies = GigyProject::all();
        return view('user.gigi.index',compact('gigies'));
    }

    public function image($name)
    {
        return view('user.gigi.image',compact('name'));
    }
    public function create()
    {
        return view('user.gigi.create');
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'projectname' => 'required',
            'projectdesc' => 'required',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
            // 'projectbudget' => 'required',
            // 'file' => 'required',
        ]);

        $images = array();

        if(isset($request->images) && count($request->images) > 0)
        {
            // $this->validate($request,[
            //     'file_mms' => 'mimes:jpg,bmp,png,jpeg,docx,txt'
            // ]);
            for($i = 0; $i < count($request->images); $i++)
            {
                $image = $request->images[$i];
                $name = time().'-'.$image->getClientOriginalName();
                $destinationPath = public_path('/assets/gigy_project');
                $imagePath = $destinationPath. "/". $name;
                $image->move($destinationPath, $name);

                $images[] = $name;
            }
        }

        $new = new GigyProject;
        $new->user_id = Auth::id();
        $new->project_name = $request->projectname;
        $new->project_description = $request->projectdesc;
        $new->start_date = ($request->start_date) ? $request->start_date : 0;
        $new->end_date = ($request->end_date) ? $request->end_date : 0;
        $new->budget = ($request->projectbudget) ? $request->projectbudget : 0;
        $new->images = json_encode($images);
        $new->save();

        return redirect()->back();
    }
}
