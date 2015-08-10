<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SettingRequest;
use App\Setting;


class SettingsController extends Controller {

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
		$settings = Setting::latest('updated_at')->paginate(10);
        return view('admin.setting.index', compact('settings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.setting.form');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest|SettingRequest $request
     * @return Response
     */
	public function store(SettingRequest $request)
	{
        Setting::create($request->all());
        flash('Create setting success!', 'success');
        return redirect('admin/settings');
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
		$setting = Setting::findOrFail($id);
        return view('admin.setting.form', compact('setting'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param QuestionRequest|SettingRequest $request
     * @return Response
     */
	public function update($id, SettingRequest $request)
	{
        $setting =  Setting::findOrFail($id);
        $setting->update($request->all());
        flash('Create setting success!', 'success');
        return redirect('admin/settings');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $setting = Setting::findOrFail($id);
        $setting->delete();
        flash('Success deleted setting!');
        return redirect('admin/settings');
	}
}
