<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Entry::class, 'entry');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $day = new \DateTime(request()->date);

        return view('entries.create')->with(compact('day'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => 'max:255|required',
            'content' => 'required',
            'date' => 'required|date'
        ]);

        $entry = new Entry($attributes + ['user_id' => auth()->id()]);
        $encryptedUserKey = auth()->user()->encrypted_user_key;
        $passwordKey = $request->session()->get('password_key');
        $encrypter = new \Illuminate\Encryption\Encrypter(
            $passwordKey, \Config::get('app.cipher')
        );

        $userKey = $encrypter->decrypt($encryptedUserKey);
        $dataEncrypter = new \Illuminate\Encryption\Encrypter(
            $userKey, \Config::get('app.cipher')
        );

        $entry->content = $dataEncrypter->encrypt($entry->content);
        $entry->save();

        return redirect('/calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry, Request $request)
    {
        $encryptedUserKey = auth()->user()->encrypted_user_key;
        $passwordKey = $request->session()->get('password_key');
        $encrypter = new \Illuminate\Encryption\Encrypter(
            $passwordKey, \Config::get('app.cipher')
        );

        $userKey = $encrypter->decrypt($encryptedUserKey);
        $dataEncrypter = new \Illuminate\Encryption\Encrypter(
            $userKey, \Config::get('app.cipher')
        );

        $entry->content = $dataEncrypter->decrypt($entry->content);

        return view('entries.edit')->with(compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $attributes = $request->validate([
            'title' => 'max:255|required',
            'content' => 'required'
        ]);

        $entry->update($attributes);

        return redirect('/calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
