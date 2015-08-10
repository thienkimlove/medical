<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\VideoRequest;
use App\Product;
use App\Video;

class VideosController extends BaseController {


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
		$videos = Video::all();
		return view('admin.video.index', compact('videos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$products = Product::lists('title', 'id');
		return view('admin.video.form', compact('products'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param QuestionRequest $request
	 * @return Response
	 */
	public function store(VideoRequest $request)
	{
		$data = $request->all();
		$data['image'] = ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '';
		$data['hot'] = ($request->input('hot') == 'on') ? true : false;
		Video::create($data);
		flash('Them moi video thanh cong!', 'success');
		return redirect('admin/videos');
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
		$products = Product::lists('title', 'id');
		$video = Video::findOrFail($id);
		return view('admin.video.form', compact('video', 'products'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param QuestionRequest $request
	 * @return Response
	 */
	public function update($id, VideoRequest $request)
	{
		$video =  Video::findOrFail($id);
		$data = $request->all();
		if ($request->file('image') && $request->file('image')->isValid()) {
			$data['image'] = $this->saveImage($request->file('image'), $video->image);
		}
		$data['hot'] = ($request->input('hot') == 'on') ? true : false;
		$video->update($data);
		flash('Sua video thành công!', 'success');
		return redirect('admin/videos');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$video = Video::findOrFail($id);
		if (file_exists(public_path('files/images/' . $video->image))) {
			@unlink(public_path('files/images/' . $video->image));
		}
		$video->delete();

		flash('Xoa video thanh cong!');
		return redirect('admin/videos');
	}
}
