<?php

use App\Post;
use App\Question;
use App\Services\LoremIpsumGenerator;
use App\Setting;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		//$this->call('PostTableSeeder');
		$this->call('ClearSeeder');
	}

}

class ClearSeeder extends Seeder {
    public function run()
    {
        $lipsum = new LoremIpsumGenerator;

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('post_tag')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('questions')->truncate();
        DB::table('settings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Setting::create([
            'name' => 'meta_title',
            'value' => 'LycoEye - Sang mat sang tuong lai',
        ]);

        Setting::create([
            'name' => 'meta_desc',
            'value' => 'LycoEye - Sang mat sang tuong lai',
        ]);

        Setting::create([
            'name' => 'meta_keywords',
            'value' => 'LycoEye, Sang mat, sang tuong lai',
        ]);

        Setting::create([
            'name' => 'lyco_page_tab1',
            'value' => '<img src="http://www.lycoeye.vn/images/lycoeye.jpg" alt="Lycoeye">',
        ]);

        Setting::create([
            'name' => 'lyco_page_tab2',
            'value' => $lipsum->getContent(500),
        ]);

        Setting::create([
            'name' => 'lyco_page_tab3',
            'value' => $lipsum->getContent(500),
        ]);


        Setting::create([
            'name' => 'video',
            'value' => '<iframe width="350" height="315" src="https://www.youtube.com/embed/gvCaHL0V-6A" frameborder="0" allowfullscreen></iframe>'
        ]);


    }
}

class PostTableSeeder extends Seeder {
    /**
     * seed
     */


    public function run()
    {
        $lipsum = new LoremIpsumGenerator;
        $image = 'default.jpg';

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('post_tag')->truncate();
        DB::table('posts')->truncate();

        DB::table('users')->truncate();
        DB::table('tags')->truncate();
        DB::table('questions')->truncate();
        DB::table('settings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name' => 'Admin',
            'email' => 'tieumaster@yahoo.com',
            'password' => Hash::make('232323')
        ]);

        for ($i = 1; $i < 20; $i ++) {
            Question::create([
                'question' => $lipsum->getContent(10, 'txt'),
                'ask_person' => $lipsum->getContent(3, 'txt'),
                'answer_person' => $lipsum->getContent(3, 'txt'),
                'answer' => $lipsum->getContent(10, 'txt')
            ]);
        }

        $tagIds = [];
        for ($i = 1; $i < 10; $i ++) {
            $tagIds[] = Tag::create([
                'name' => $lipsum->getContent(3, 'txt')
            ])->id;
        }

        Setting::create([
            'name' => 'meta_title',
            'value' => 'LycoEye - Sang mat sang tuong lai',
        ]);

        Setting::create([
            'name' => 'meta_desc',
            'value' => 'LycoEye - Sang mat sang tuong lai',
        ]);

        Setting::create([
            'name' => 'meta_keywords',
            'value' => 'LycoEye, Sang mat, sang tuong lai',
        ]);

        Setting::create([
            'name' => 'lyco_page_tab1',
            'value' => '<img src="http://www.lycoeye.vn/images/lycoeye.jpg" alt="Lycoeye">',
        ]);

        Setting::create([
            'name' => 'lyco_page_tab2',
            'value' => $lipsum->getContent(500),
        ]);

        Setting::create([
            'name' => 'lyco_page_tab3',
            'value' => $lipsum->getContent(500),
        ]);


        Setting::create([
            'name' => 'video',
            'value' => '<iframe width="350" height="315" src="https://www.youtube.com/embed/gvCaHL0V-6A" frameborder="0" allowfullscreen></iframe>'
        ]);





        $selection = [
            'sang-mat-sang-tuong-lai' => 'Sáng mắt tương lai',
            'su-kien-nhan-hang' => 'Sự kiện nhãn hàng',
            'chia-se' => 'Chia sẻ'
        ];

        foreach ($selection as $key => $value) {
            for ($i = 1; $i < 40; $i ++) {
                $rand = rand(0,10);
                $homepage_slide = ($rand == 1) ? true : false;
                $homepage_intro = ($rand == 2) ? true : false;
                $homepage_discovery = ($rand == 3) ? true : false;
                $hot = ($rand == 4) ? true : false;
                $reason = ($rand == 5) ? true : false;

                $post = Post::create([
                    'type' => $key,
                    'title' => $lipsum->getContent(10, 'txt').' '.Uuid::generate(),
                    'desc' => $lipsum->getContent(20, 'plain'),
                    'content' => $lipsum->getContent(500),
                    'homepage_slide' => $homepage_slide,
                    'homepage_intro' => $homepage_intro,
                    'homepage_discovery' => $homepage_discovery,
                    'hot' => $hot,
                    'reason' => $reason,
                    'image' => $image,
                    'status' => true
                ]);
                $post->tags()->sync(array_slice($tagIds, 0, rand(1, 10)));
            }
        }

    }
}
