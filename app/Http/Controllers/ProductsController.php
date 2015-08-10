<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Product;

class ProductsController extends BaseController {


	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();
		return view('admin.product.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.product.form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param QuestionRequest $request
	 * @return Response
	 */
	public function store(ProductRequest $request)
	{
		$data = $request->all();
		$data['image'] = ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '';
		Product::create($data);
		flash('Them moi san pham thanh cong!', 'success');
		return redirect('admin/products');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = Product::findOrFail($id);
		return view('admin.product.form', compact('product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param QuestionRequest $request
	 * @return Response
	 */
	public function update($id, ProductRequest $request)
	{
		$product =  Product::findOrFail($id);
		$data = $request->all();
		if ($request->file('image') && $request->file('image')->isValid()) {
			$data['image'] = $this->saveImage($request->file('image'), $product->image);
		}
		$product->update($data);
		flash('Sua san pham thành công!', 'success');
		return redirect('admin/products');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		if (file_exists(public_path('files/images/' . $product->image))) {
			@unlink(public_path('files/images/' . $product->image));
		}
		$product->delete();

		flash('Xoa product thanh cong!');
		return redirect('admin/products');
	}
}
