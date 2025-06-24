<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointsController extends Controller
{

    public function __construct()
    {
        $this->points = new PointsModel;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $points = DB::table('points')
        ->select(
            'id',
            DB::raw('ST_Y(geom) as lat'),
            DB::raw('ST_X(geom) as lng'),
            'name' // pastikan kolom ini ada
        )
        ->get();

    $title = 'Peta Wisata Temanggung'; // Atur judul yang kamu inginkan

    return view('map', compact('points', 'title'));
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
    public function store(Request $request)
    {
        //Validation
        $request->validate(
            [
                'name' => 'required|unique:points,name',
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Location is required',
            ]
        );

        // Create images directory if nor exists
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get Image File
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'user_id'=> auth()->user()->id,
        ];

        //Create Data
        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('error', 'Point Failed to add');
        }

        //Redirect to map
        return redirect()->route('map')->with('success', 'Point has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Point',
            'id' => $id,
        ];

        return view('edit-point', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //Validation
        $request->validate(
            [
                'name' => 'required|unique:points,name,' . $id,
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Location is required',
            ]
        );

        // Create images directory if nor exists
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get Old Image File Name
        $old_image = $this->points->find($id)->image;

        // Get Image File
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            //Delete Old Image
            if ($old_image != null && file_exists('./storage/images/' . $old_image)) {
                unlink('./storage/images/' . $old_image);
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        //Update Data
        if (!$this->points->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Point failed to update');
        }

        //Redirect to map
        return redirect()->route('map')->with('success', 'Point has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->points->find($id)->image;

        if (!$this->points->destroy($id)) {
            return redirect()->route('map')->with('error', 'Point Failed to delete');
        }
        //Delete Image
        if ($imagefile != null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }
        return redirect()->route('map')->with('success', 'Point has been deleted');
    }
}
