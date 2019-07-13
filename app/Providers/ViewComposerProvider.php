<?php namespace App\Providers;

use App\Banner;
use App\Category;
use App\Post;
use App\Question;
use App\Setting;
use App\Video;
use DB;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		DB::listen(function($sql, $bindings) {

			for($j=0; $j<sizeof($bindings); $j++) {
				$sql = implode($bindings[$j], explode('?', $sql, 2));
			}
			$logFile = fopen(storage_path('logs/query.log'), 'a+');
			//write log to file
			fwrite($logFile, $sql . "\n");
			fclose($logFile);
		});


        view()->composer('frontend.right', function ($view) {
			$slidePosts = Post::whereHas('modules', function($q){
				$q->where('slug', 'tin-tuc-noi-bat')->orderBy('order');
			})->limit(6)->get();
            $view->with('noibat', $slidePosts);

        });

        view()->composer('frontend.box_event', function ($view) {
            $view->with('events', Post::where('status', true)->where('type', 'su-kien-nhan-hang')->latest('updated_at')->limit(3)->get());

        });

		view()->composer('frontend.box_video', function ($view) {
			$view->with('videoLists', Video::latest('updated_at')->limit(3)->get());
		});

		view()->composer('frontend.box_question', function ($view) {
			$view->with('slideQuestions', Question::latest('updated_at')->limit(3)->get());
		});


		view()->composer('frontend.box_adv_normal', function ($view) {
			$settings = Setting::lists('value', 'name');
			$view->with('html', $settings['adv_normal']);
		});

		view()->composer('frontend.box_adv_center', function ($view) {
			$settings = Setting::lists('value', 'name');
			$view->with('html', $settings['adv_center']);
		});
		view()->composer('frontend.box_adv_hoidap', function ($view) {
			$settings = Setting::lists('value', 'name');
			$view->with('html', $settings['adv_hoidap']);
		});

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
