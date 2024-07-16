<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientLogin;
use Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //onlyTrashed() work with softDeletes, return all deleted record
        // $clients = Client::onlyTrashed()->get();
        $clients = Client::all();
        return view('client.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $this->validate($request, [
    //         'full_name' => 'required',
    //         'email' => 'required',
    //         'profile_image' => 'image|mimes:jpeg,png,jpg',
    //         'login_email' => 'unique:client_logins,email',
    //     ],
    //     [
    //         'profile_image.mimes'=> 'Image must be in jpeg, png, jpg',
    //     ]
    // );

        $client = new Client;

        $client->full_name = $request->full_name;
        $client->gender = $request->gender;
        $client->email = $request->email;
        $client->mobile_no = $request->mobile_no;
        $client->country = $request->country;
        $client->city = $request->city;
        $client->address = $request->address;
        $client->payment_resource = $request->payment_resource;
        $client->skype = $request->skype;
        $client->state_province = $request->state_province;
        $client->note = $request->note;
        $client->source = $request->source;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('/storage/client_profile_images');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $client->profile_image = $name;
        }

        $client->save();

        // if($client->save()){
        //     ClientLogin::create([
        //         'client_id' => $client->id,
        //         'email' => $request->login_email,
        //         'password' => Hash::make($request->password),
        //         'status' => $request->status
        //     ]);
        // }

        return redirect('client/create')->with('success', 'Record has been submited');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required',
            'payment_resource'=> 'required'
        ]);

        $client = Client::find($id);

        $client->full_name = $request->full_name;
        $client->gender = $request->gender;
        $client->state_province = $request->state_province;
        $client->email = $request->email;
        $client->mobile_no = $request->mobile_no;
        $client->country = $request->country;
        $client->city = $request->city;
        $client->address = $request->address;
        $client->payment_resource = $request->payment_resource;
        $client->skype = $request->skype;
        $client->note = $request->note;
        $client->source = $request->source;

        $client->save();

        return redirect()->back()->with('update', 'Record had been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect('client')->with('delete', 'Record has been deleted');
    }
}
