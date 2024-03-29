<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;

/**
 * @access public
 * @author Uday Kumar
 * @version 1.0.0
 */
class UserController extends Controller {
    protected $request;
    protected $user;
    
    /**
     *
     * @param Request $request
     * @param Product $user
     */
    public function __construct(Request $request, User $users) {
        $this->request = $request;
        $this->users = $users;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $user = $this->user->all();
        return response()->json(['data' => $user,
            'status' => Response::HTTP_OK]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $this->request->all();
    	 $this->users->name = $data['name'];
        $this->users->email = $data['email'];
        $this->users->password = $data['password'];
        $this->users->save();
        
        return response()->json(['status' => Response::HTTP_CREATED]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        $data = $this->request->all();
        
        $user = $this->user->find($id);
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        
        return response()->json(['status' => Response::HTTP_OK]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = $this->user->find($id);
        $user->delete();
        
        return response()->json(['status' => Response::HTTP_OK]);
    }
    
}

//end of class UserController
//end of file UserController.php