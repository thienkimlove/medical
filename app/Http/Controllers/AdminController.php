<?php namespace App\Http\Controllers;

use App\Http\Requests;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * admin landing page.
     * @return \Illuminate\View\View
     */
    public function index()
	{
        $page = 'Dashboard';
		return view('admin.index', compact('page'));
	}

    /**
     * form example with upload.
     * @return \Illuminate\View\View
     */
    public function form()
    {
        return view('partials.form');
    }


}
