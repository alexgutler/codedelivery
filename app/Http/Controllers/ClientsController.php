<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminClientRequest;

class ClientsController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $repository){
        $this->clientRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->clientRepository->paginate();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminClientRequest $request)
    {
        $inputs = $request->all();
        $this->clientRepository->create($inputs);

        return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->clientRepository->find($id);
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminClientRequest $request, $id)
    {
        $inputs = $request->all();
        $this->clientRepository->update($inputs, $id);
        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
