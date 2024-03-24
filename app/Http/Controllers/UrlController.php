<?php

namespace App\Http\Controllers;

use App\Models\url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required',
            'status' => 'required'
        ]);

        $urlCreatedCount = auth()->user()->Urls()->count();

        if($urlCreatedCount >= auth()->user()->allowed_request){
            return response()->json([
                'status' => false,
                'message' => 'Limit Exced'
            ],422);
        }

        $shortUrl = $this->generateUrl();

        $request = [
            'user_id' => auth()->user()->id,
            'encryptUrl' => $shortUrl,
            'orgUrl' => request()->url,
            'status' => request()->status == 'true'
        ];

        url::create($request);

        return response()->json([
            'status' => true,
            'message' => 'Short Url created successfully',
            'url' => config('app.url').$shortUrl
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(url $url)
    {
        if($url->user_id == auth()->user()->id){

            return response()->json([
                'status' => true,
                'message' => 'removed successfully',
                'data' => $url
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Record not found'
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, url $url)
    {
        request()->validate([
            'url' => 'required',
            'status' => 'required'
        ]);

        $url->orgUrl = request()->url;
        $url->status = request()->status == 'true';
        $url->save();

        return response()->json([
            'status' => true,
            'message' => 'Short Url updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(url $url)
    {
        if($url->user_id == auth()->user()->id){

            $url->delete();

            return response()->json([
                'status' => true,
                'message' => 'removed successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Record not found'
        ],404);
    }

    public function updatePackage(){
        request()->validate([
            'package' => 'required|in:' . implode(',',array_keys(url::package))
        ]);

        $user = auth()->user();
        $user->package = request('package');
        $user->allowed_request = url::package[request('package')];
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Package Update successfully'
        ]);
    }

    private function generateUrl(){
        $key = Str::random(9);
        if(url::where('encryptUrl',$key)->count() > 0){
            $this->generateUrl();
        }else{
            return $key;
        }
    }
}
