<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\PoliceStation;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::withWhereHas('roles')->latest()->get();
        $wards = Ward::latest()->get();
        $roles = Role::whereIn('id', [2,4])->get();
        $police_stations = PoliceStation::latest()->get();

        return view('admin.users')->with(['users' => $users, 'wards' => $wards, 'roles' => $roles, 'police_stations' => $police_stations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();

            $input['password'] = Hash::make($input['password']);
            $user = User::create(Arr::only($input, Auth::user()->getFillable()));
            $role = Role::find($input['user_type']);
            $user->assignRole([$role->id]);
            DB::commit();

            return response()->json(['success' => 'User created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'User');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $wards = Ward::latest()->get();
        $police_stations = PoliceStation::latest()->get();
        $roles = Role::whereIn('id', [2, 4])->get();
        if ($user) {

            $wardHtml = '<span>
                <option value="">--Select Ward--</option>';
            foreach ($wards as $ward) :
                $is_select = $ward->id == $user->ward_id ? "selected" : "";
                $wardHtml .= '<option value="' . $ward->id . '" ' . $is_select . '>' . $ward->name . '</option>';
            endforeach;
            $wardHtml .= '</span>';

            $policeHtml = '<span>
                <option value="">--Select Police--</option>';
            foreach ($police_stations as $police_station) :
                $is_select = $police_station->id == $user->ward_id ? "selected" : "";
                $policeHtml .= '<option value="' . $police_station->id . '" ' . $is_select . '>' . $police_station->police_station . '</option>';
            endforeach;
            $policeHtml .= '</span>';

            $userTypeHtml = '<span>
                <option value="">--Select User Type --</option>';
                foreach($roles as $role):
                    $is_select = $role->id == $user->roles[0]->id ? "selected" : "";
                    $userTypeHtml .= '<option value="'.$role->id.'" '.$is_select.'>'.$role->name.'</option>';
                endforeach;
            $userTypeHtml .= '</span>';

            $response = [
                'result' => 1,
                'user' => $user,
                'wardHtml' => $wardHtml,
                'policeHtml' => $policeHtml,
                'userTypeHtml' => $userTypeHtml
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();

            $user->update( Arr::only( $input, Auth::user()->getFillable() ) );
            DB::commit();

            return response()->json(['success'=> 'Uset updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'User');
        }
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        try
        {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return response()->json(['success'=> 'User deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'User');
        }
    }
}
