<?php

namespace App\Http\Controllers;

use App\Models\LandingPageSection;
use App\Http\Requests\StoreLandingPageSectionRequest;
use App\Http\Requests\UpdateLandingPageSectionRequest;
use App\Models\Product;
use DB;

class LandingPageSectionController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLandingPageSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandingPageSectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LandingPageSection  $landingPageSection
     * @return \Illuminate\Http\Response
     */
    public function show(LandingPageSection $landingPageSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandingPageSection  $landingPageSection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $n['data'] = LandingPageSection::where('product_id', $id)->get();
        $n['product_id'] = $id;
        return view('backend.pages.landing-page.sections', $n);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandingPageSectionRequest  $request
     * @param  \App\Models\LandingPageSection  $landingPageSection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandingPageSectionRequest $request, $product_id)
    {
        // DB::table('landing_page_sections')->where('product_id', $product_id)->delete();

        $data = $request->validated();

        foreach ($data['sections'] as $datum) {

            // Handle image upload
            if (isset($datum['image']) && $datum['image'] instanceof \Illuminate\Http\UploadedFile) {
                $imagePath = $datum['image']->store('landing-page', 'public');
                $datum['image'] = $imagePath;
            }
            $datum['created_at'] = now();
            $datum['product_id'] = $product_id;
            // dd($datum);
            if (isset($datum['id'])) {
                DB::table('landing_page_sections')->where('id', $datum['id'])->update($datum);
            } else {
                DB::table('landing_page_sections')->insert($datum);
            }

        }


        return back()->with('success', 'Data saved successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandingPageSection  $landingPageSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(LandingPageSection $landingPageSection)
    {
        //
    }
}
