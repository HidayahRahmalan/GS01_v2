<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Store a new text descriptor assignment for an image.
     */
    public function store(Request $request)
    {
        // 1. Strict input validation matching your custom column structural keys
        $request->validate([
            'image_ID' => 'required|exists:image,image_ID',
            'tag_name' => 'required|string|max:100',
        ]);

        // Clean up the text input string (remove accidental trailing spaces)
        $cleanTagName = trim($request->tag_name);

        // 2. Fetch or dynamically create the word in the master 'tag' dictionary table
        $tag = Tag::firstOrCreate([
            'tag_name' => $cleanTagName
        ]);

        // Find the target image record
        $image = Image::findOrFail($request->image_ID);

        // FIX: Explicitly reference the custom user_ID column from your active auth session
        $activeUserID = Auth::user() ? Auth::user()->user_ID : 1; 

        // 3. Safety Check: Verify if THIS specific user has already added THIS exact tag to THIS photo
        $alreadyExists = $image->tags()
            ->where('image_tag.tag_ID', $tag->tag_ID)
            ->where('image_tag.user_ID', $activeUserID)
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'You have already assigned this descriptor to this image!');
        }

        // 4. Attach the link to your 3-column 'image_tag' table safely
        $image->tags()->attach($tag->tag_ID, [
            'user_ID' => $activeUserID
        ]);

        return back()->with('success', 'TBR Description successfully indexed!');
    }
}