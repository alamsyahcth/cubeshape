<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {

    private $path = 'user';
    private $role = 'super-admin';

    public function index() {
        $page = $this->path;
        $data = User::where('role', 1)->get();
        return view('backend'.$this->role.'.'.$this->path.'.index', compact(['data','page']));
    }

    public function edit($id) {
        $page = $this->path;
        $data = User::where('id', $id)->first();
        return view('backend'.$this->role.'.'.$this->path.'.update', compact(['data','page']));
    }

    public function update(Request $request, $id) {
        $validate = $this->validate($request, [
            'name' => 'required'
        ]);
        if ($validate) {
            $data = User::where('id', $id)->update([
                'name' => $request->name,
                'status_id' => $request->status
            ]);
            if($data) {
                notify()->success('Page '.$this->path.' has been saved');
                return redirect($this->role.'/'.$this->path);
            } else {
                notify()->error('Page '.$this->path.' cant saved');
                return redirect($this->role.'/'.$this->path.'/'.$id);
            }
        }
    }

    public function destroy($id) {
        $data = User::where('id', $id)->first();
        if($data->delete()) {
            notify()->success('Page '.$this->path.' has been deleted');
            return redirect($this->role.'/'.$this->path);
        } else {
            notify()->error('Page '.$this->path.' cant deleted');
            return redirect($this->role.'/'.$this->path.'/'.$id);
        }
    }
}
