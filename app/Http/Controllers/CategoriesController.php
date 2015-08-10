<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;

use App\Http\Requests\CategoryRequest;
use App\Post;


class CategoriesController extends BaseController
{
    public $parents;

    public function __construct()
    {
        $this->middleware('admin');
        $this->parents = array('' => 'Choose parent category') + Category::whereNull('parent_id')->lists('name', 'id');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $parents = $this->parents;
        return view('admin.category.form', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->input('name'),
            'parent_id' => ($request->input('parent_id') == 0) ? null : $request->input('parent_id'),
        ]);

        flash('Create category success!', 'success');
        return redirect('admin/categories');
    }


    /**
     * display form for edit category
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $parents = $this->parents;
        $category = Category::find($id);
        return view('admin.category.form', compact('parents', 'category'));
    }

    /**
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CategoryRequest $request)
    {
         $category = Category::find($id);

        //category nao display bai cua category do.

        //moi lien he cha con chi dung khi hien thi.

        if ($category->parent_id && $request->input('parent_id') == 0) {
            Post::where('category_id', $category->id)->update(['category_id' => $category->parent_id]);
        }

         $category->update([
             'name' => $request->input('name'),
             'parent_id' => ($request->input('parent_id') == 0) ? null : $request->input('parent_id'),
         ]);

         flash('Update category success!', 'success');
         return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        Post::where('category_id', $category->id)->delete();

        $category->delete();

        flash('Success deleted category!');

        return redirect('admin/categories');
    }



}
