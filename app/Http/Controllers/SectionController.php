<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Section;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($themeId)
    {
	    $sections = Section::SectionTheme($themeId)->get();
	    $theme = Theme::find($themeId);

	    return view('sections', ["themeId" => $themeId, "themeName" => $theme->name, "sections" => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request, $themeId)
    {
	    $theme = Theme::find($themeId);

	    if($theme->user_id == Auth::id()) {
	    	$data = $request->validated();
	    	$data["theme_id"] = $themeId;

		    $section = Section::create( $data );

		    return redirect( "/theme/$themeId/sections/$section->id/fields" );
	    } else {
	    	return response()->json(["success" => false, "message" => "Invalid Theme ID"]);
	    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, $themeId, $id)
    {
        $section = Section::find($id);

	    if($section->theme->user_id == null || $section->theme->user_id == Auth::id()) {
		    $section->update( $request->validated() );
		    return response()->json( [ "success" => true ] );
	    } else {
	    	return response()->json(["success" => false, "message" => "Invalid Section ID"]);
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($themeId, $sectionId)
    {
        $section = Section::find($sectionId);

        if($section != null) {
	        $theme = $section->theme;

	        if( ($theme->user_id == null || $theme->user_id == Auth::id()) && $theme->id == $themeId) {
		        $section->fields()->delete();
		        $section->delete();

		        return response()->json(["success" => true]);
	        }
        }

	    return response()->json(["success" => false, "message" => "Invalid Section ID"]);
    }
}
