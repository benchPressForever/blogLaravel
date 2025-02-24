<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAndStorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        return PostResource::collection(Post::with(['category','comment','user'])->paginate(5));
    }

    public function show($id){
        $post = Post::query()->findOrFail($id);
        return (new PostResource($post))->additional([
            'success' => true,
            'message' => 'Posts retrieved successfully',
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Posts validation error',
                'errors' => $validator->errors()
            ]);
        }

        $post = Post::query()->findOrFail($id)->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Posts updated successfully',
            'post' => $post,
        ]);
    }

    public function delete($id){
        $post = Post::query()->findOrFail($id);

        if($post->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Posts deleted successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Posts deleted unsuccessfully',
        ]);
    }
}
