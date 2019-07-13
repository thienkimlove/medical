<?php namespace App\Http\Controllers;


use App\Category;
use App\Http\Requests;


use App\Http\Requests\PostRequest;
use App\Module;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends BaseController {

    public $modules, $tags, $categories;

    public function __construct()
    {
        $this->middleware('admin');

        $this->modules = [
            'best-news-trang-chu' => 'Hiện thị trang chủ',
        ];


        $categories = Category::all()->filter(function($item){
            return $item->subCategories->count() == 0;
        })->lists('name', 'id');

        $this->categories = array('' => 'Choose category') + $categories;
        $this->tags = Tag::lists('name', 'name');
    }

    protected function syncModules($request, $post)
    {
        if (!empty($request->input('modules'))) {
            foreach ($request->input('modules') as $key => $values) {
                if (isset($values['display'])) {
                    $order = (int) $values['order'];
                    $module = Module::where('post_id', $post->id)
                        ->where('slug', $key)
                        ->first();
                    if ($module) {
                        $module->order = $order;
                        $module->save();
                    } else {
                        Module::create([
                            'post_id' => $post->id,
                            'slug' => $key,
                            'order' => $order,
                        ]);
                    }
                } else {
                    Module::where('slug', $key)
                        ->where('post_id', $post->id)
                        ->delete();
                }
            }
        }
    }

    protected function syncTags($request, Post $post)
    {
        $tagIds = [];
        foreach ($request->input('tag_list') as $tag) {
            $tagIds[] = Tag::firstOrCreate(['name' => $tag])->id;
        }
        $post->tags()->sync($tagIds);
    }

    public function index(Request $request)
    {

        $searchPost = '';
        $categoryId = '';
        $posts = Post::latest('updated_at');
        if ($request->input('q')) {
            $searchPost = urldecode($request->input('q'));
            $posts = $posts->where('title', 'LIKE', '%'. $searchPost. '%');
        }

        if ($request->input('cat')) {
            $categoryId = $request->input('cat');
            $posts = $posts->where('category_id', '=', $categoryId);
        }

        $posts = $posts->paginate(10);

        return view('admin.post.index', compact('posts', 'searchPost', 'categoryId'));
    }

    public function create()
    {
        $tags = $this->tags;
        $categories = $this->categories;
        $modules = $this->modules;
        return view('admin.post.form', compact('tags', 'categories', 'modules'));
    }

    public function store(PostRequest $request)
    {
       // dd($request->all());
        $insert = [
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'desc' => $request->input('desc'),
            'content' => $request->input('content'),
            'image' => ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '',
            'status' => ($request->input('status') == 'on') ? true : false,
        ];

        $post = Post::create($insert);
        $this->syncTags($request, $post);
        $this->syncModules($request, $post);

        flash('Create post success!', 'success');
        return redirect('admin/posts');
    }

    /**
     * display form for edit post
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = $this->tags;
        $categories = $this->categories;
        $modules = $this->modules;
        return view('admin.post.form', compact('tags', 'categories', 'modules', 'post'));
    }


    public function update($id, PostRequest $request)
    {
        $post = Post::find($id);
        $update = [
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'desc' => $request->input('desc'),
            'content' => $request->input('content'),
            'status' => ($request->input('status') == 'on') ? true : false,
        ];
        if ($request->file('image') && $request->file('image')->isValid()) {
            $update['image'] = $this->saveImage($request->file('image'), $post->image);
        }


        $post->update($update);
        $this->syncTags($request, $post);
        $this->syncModules($request, $post);
        flash('Update post success!', 'success');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (file_exists(public_path('files/images/' . $post->image))) {
            @unlink(public_path('files/images/' . $post->image));
        }
        $post->delete();
        flash('Success deleted post!');
        return redirect('admin/posts');
    }


}
