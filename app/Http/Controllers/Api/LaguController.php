<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaguDaerah;
use Illuminate\Http\Request;

class LaguController extends Controller
{
    public function index(){
        $laguDaerahs =  LaguDaerah::orderBy('id', 'DESC')->paginate(10);
        return response()->json([
            'status'  => 'success',
            'data' => $laguDaerahs
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'lagu' => 'required',
            'daerah' => 'required',
            'image' => 'required',
        ]);

        $laguDaerah =  new LaguDaerah;
        $laguDaerah->judul = $request->judul;
        $laguDaerah->lagu = $request->lagu;
        $laguDaerah->daerah = $request->daerah;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = time().'.'.$request->image->extension();
            $image->storeAs('public/images', $fileName);
            $laguDaerah->image_url = $fileName;
        }
        $laguDaerah->save();
        

        return response()->json([
            'status' => 'success',
            'data' => $laguDaerah
        ], 201);
    }

    public function update(request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'lagu' => 'required',
            'daerah' => 'required',
        ]);

        $laguDaerah = LaguDaerah::find($id);
        $laguDaerah->judul = $request->judul;
        $laguDaerah->lagu = $request->lagu;
        $laguDaerah->daerah = $request->daerah;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = time().'.'.$request->image->extension();
            $image->storeAs('public/images', $fileName);
            $laguDaerah->image_url = $fileName;
        }
        $laguDaerah->save();

        return response()->json([
            'status' => 'success',
            'data' => $laguDaerah
        ], 200);
    }

    public function delete($id)
    {
        $laguDaerah = LaguDaerah::find($id);
        $laguDaerah->delete();

        return response()->json([
            'status' => 'success',
            'data' => null
        ], 204);
    }
}
