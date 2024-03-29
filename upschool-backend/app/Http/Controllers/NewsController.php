<?php

namespace App\Http\Controllers;

use App\File;
use App\News;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        //
        $news = News::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the news items retrieved',
            'data' => $news->load('image')
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $currentSemester = Semester::latest()->first();
        // $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input('image')));

        // // Storage::put('yooo.jpg', $data);
        // dd($data);

        $news = new News();
        $news->title = $request->title;
        $news->body  = $request->body;
        $news->featured = $request->featured;
        $news->semester_id = $currentSemester->id;

        $news->save();


        if ($request->hasFile('image')) {
            $path = Storage::putFileAs(
                'images/news-images',
                $request->file('image'),
                preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $request->title . $request->file('image')->getClientOriginalName()))
            );

            if ($path) {

                $file = new File();
                $file->name = $request->file('image')->getClientOriginalName();
                $file->type = $request->file('image')->getClientMimeType();
                $file->path = $path;
                $file->fileable_id = $news->id;
                $file->fileable_type = 'App\News';

                $file->save();

                return response()->json([
                    'status' => true,
                    'message' => 'news post created successfully',
                    'data' => $news->load('image')
                ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'something went wrong',
                    'data' => []
                ], 201);
            }
        }
    }

    public function show(News $news, $id)
    {
        //
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'status' => false,
                'message' => 'This news does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved news',
            'data' => $news->load('image')
        ], 201);
    }

    public function update(Request $request, News $news)
    {
        //
    }

    public function destroy($id)
    {
        //
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'status' => false,
                'message' => 'This news does not exist',
                'data' => []
            ], 201);
        }

        // $news->load('image');

        $file = File::whereFileableType('App\News')->whereFileableId($news->id)->first();

        $file->delete();
        $news->delete();

        return response()->json([
            'status' => true,
            'message' => 'News deleted successfully',
            'data' => []
        ], 201);
    }
}
