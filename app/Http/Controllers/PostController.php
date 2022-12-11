<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getAllPost()
    {
        //cach 1 query builder
        // $posts = DB::table('posts')->get();
        // $posts = DB::table('posts')->orderBy('created_at', 'desc')->paginate(1);
        //cach 2 eloquent
        $posts = Post::orderBy('id', 'desc')->paginate(1);
        $post = Post::find(2); //id cua bang post xem thuoc danh muc nao 
        // dd($post->category);

        //return view('enduser.blog',['posts'=>$posts]);
        //return view('enduser.blog')->with('posts',$posts);
        return view('enduser.blog', compact('posts'));
    }
    public function getPost()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.post.list')->with('datas', $posts);
    }
    public function getViewPostAdd()
    {
        $posts = Post::all();
        return view('admin.post.add')->with('posts', $posts);
    }
    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:200',
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif,svg|max:10240',
        ]);
        if ($request->image) {
            $imageName = uniqid() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('image'), $imageName);
        }
        $post = Post::create([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $imageName ?? '',
        ]);
        return redirect()->route('post.list');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('post.list');
    }

    public function getPostDetail($id)
    {
        $post = Post::find($id);
        return view('admin.post.edit')->with('post', $post);
    }
    public function editPost(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5|max:200',
            'content' => 'required',
        ]);
        $post = Post::find($id);
        $post->name = $request->name;
        $post->content = $request->content;


        if ($request->imagepost) {

            $imageName = uniqid() . '_' . $request->imagepost->getClientOriginalName();
            $request->imagepost->move(public_path('image'), $imageName);

            unlink("image/" . $post->image);
            $post->image = $imageName ?? '';
        }
        $post->save();
        return redirect()->route('post.edit', $post->id)->with('success', 'Edit Successfully');
    }
}
