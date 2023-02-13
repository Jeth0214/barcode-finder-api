<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\Item;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transfers = Transfer::with('items')->get();

        return response()->json($transfers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $error = $request->validate([
            'brand' => 'required',
            'barcode' => 'required',
            'gt' => 'required',
            'supplier_id' => 'required'
        ]);

        $transfer = Transfer::create($request->all());
        $allItems = array();
        if(isset($transfer)) {
            foreach($request->items as $item) { 
                $transfer_id = [
                    'transfer_id' => $transfer->id
                ];
                $itemToSave= array_merge($transfer_id, $item);
                $savedItem = Item::create($itemToSave);
            };
        };

        if(isset($savedItem) && isset($transfer)) {
            return response()->json([
                'message' => 'Success'
            ], 200);
        }else {
            return response()->json([
                'message' => 'Error'
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
