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
        // dd($data);
        foreach ($data['sections'] as $datum) {

            // Handle image upload
            if (isset($datum['image']) && $datum['image'] instanceof \Illuminate\Http\UploadedFile) {
                $imagePath = $datum['image']->store('landing-page', 'public');
                $datum['image'] = $imagePath;
            }
            
            $datum['created_at'] = now();
            $datum['product_id'] = $product_id;
            $datum['video_link'] = $datum['video_link'] ?? null;
            $datum['title'] = $datum['title'] ?? null;
            $datum['sub_title'] = $datum['sub_title'] ?? null;
            $datum['description'] = $datum['description'] ?? null;
            $datum['button'] = $datum['button'] ?? null;
            $datum['is_with_previous'] = $datum['is_with_previous'] ?? false;

            // dd($datum);
            if (isset($datum['id'])) {
                DB::table('landing_page_sections')->where('id', $datum['id'])->update($datum);
            } else {
                DB::table('landing_page_sections')->insert($datum);
            }

        }


        return back()->with('success', 'Data saved successfully');

    }


}
