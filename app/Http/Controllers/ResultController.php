<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\VisualFeature;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Handles Multi-Strategy Multimedia Search & Filtering 
     * (Supports ABR, TBR, and CBR)
     */
    public function index(Request $request)
    {
        // Capture the selected search tab strategy from Puteri's UI layout (Defaults to ABR)
        $strategy = $request->input('strategy', 'ABR');
        
        // Start an Eloquent query builder instance with relationships eager-loaded
        $query = Image::with(['visualFeature', 'tags']);

        // --- STRATEGY 1: Attribute-Based Retrieval (ABR) ---
        if ($strategy === 'ABR') {
            // Filter by formal image file extensions (e.g., PNG, JPG)
            if ($request->filled('image_format')) {
                $query->where('image_format', $request->image_format);
            }
            // Filter by file size limits if specified
            if ($request->filled('max_size')) {
                $query->where('file_size', '<=', $request->max_size);
            }
        }

        // --- STRATEGY 2: Text-Based Retrieval (TBR) ---
        elseif ($strategy === 'TBR') {
            if ($request->filled('keyword')) {
                $search = $request->keyword;
                
                // Match keywords against the custom image description OR mapped table tags
                $query->where(function($q) use ($search) {
                    $q->where('description', 'LIKE', "%{$search}%")
                      ->orWhereHas('tags', function($tagQuery) use ($search) {
                          $tagQuery->where('tag_name', 'LIKE', "%{$search}%");
                      });
                });
            }
        }

        // --- STRATEGY 3: Content-Based Retrieval (CBR) ---
        elseif ($strategy === 'CBR') {
            // We join or check the dependent visual_feature relation table attributes
            $query->whereHas('visualFeature', function($q) use ($request) {
                if ($request->filled('clothing_type')) {
                    $q->where('clothing_type', $request->clothing_type);
                }
                if ($request->filled('background_type')) {
                    $q->where('background_type', $request->background_type);
                }
                if ($request->filled('camera_posture')) {
                    $q->where('camera_posture', $request->camera_posture);
                }
            });
        }

        // Execute query and order results by latest uploads
        $images = $query->latest()->get();

        // Return view panel with the collections and the active selected strategy tab state
        return view('result', compact('images', 'strategy'));
    }

    /**
     * Retained single detail view method if needed for detailed result profiling
     */
    public function show($id)
    {
        $image = Image::with(['visualFeature', 'tags', 'user'])->findOrFail($id);
        return view('result', compact('image'));
    }
}