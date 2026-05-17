<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Support\HtmlSanitizer;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        // return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'position' => 'nullable|max:100',
            'message' => 'required|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'position', 'message']);
        $data['message'] = HtmlSanitizer::clean($data['message']);

        if ($request->hasFile('photo')) {
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $filename);
            $data['photo'] = $filename; // simpan path relatif
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created!');
    }

    public function edit(Testimonial $testimonial)
    {
        // return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|max:100',
            'position' => 'nullable|max:100',
            'message' => 'required|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'position', 'message']);
        $data['message'] = HtmlSanitizer::clean($data['message']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($testimonial->photo && file_exists(public_path('images/'.$testimonial->photo))) {
                unlink(public_path('images/'.$testimonial->photo));
            }

            // Upload foto baru
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $filename);
            $data['photo'] = $filename;
        }

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted!');
    }
}
