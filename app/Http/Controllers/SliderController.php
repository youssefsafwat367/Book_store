<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.sliders', compact('sliders'));
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
        $slider = $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required',
            ]
        );
        $image = $slider['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $slider['image'] = $imageName;
        slider::create($slider);
        $image->move(public_path('assets/uploads/sliders'), $imageName);
        return back()->with('success', 'The Slider Is Created Successfully');
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
        $slider = slider::find($id);
        return view('admin.sliders.edit_slider', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::find($id);
        $new_slider = $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required',
            ]
        );
        $slider_old_image = $slider->image ;
        File::delete(public_path('assets/uploads/sliders/')."$slider_old_image") ;
        $image= $new_slider['image'] ;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/sliders'), $imageName);
        $new_slider['image'] = $imageName ;
        $slider->update($new_slider);
        $slider->image = $imageName ;
        $slider->save() ;
        return redirect()->route('admin.sliders')->with('success', 'The slider Is Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = slider::find($id) ;
        File::delete(public_path("assets/uploads/sliders/"."$slider->image")) ;
        $slider->delete() ;
        return redirect()->route('admin.sliders')->with('danger' , 'The slider is Deleted Successfully') ;
    }
}
