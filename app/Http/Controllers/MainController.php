<?php namespace App\Http\Controllers;


use App\Category;
use App\Contact;
use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\RegisterEmailRequest;
use App\Post;
use App\Product;
use App\Question;
use App\Setting;
use App\Tag;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{

    private function _prepareCategory($slug)
    {
        return  Category::where('slug', $slug)->first();
    }

    public function index()
    {
        $page = 'index';
        $congdung = $this->_prepareCategory('cong-dung');
        $thongtinkhoahoc = $this->_prepareCategory('thong-tin-khoa-hoc');
        $tintuc = $this->_prepareCategory('tin-tuc');

        return view('frontend.index', compact(
            'congdung', 'thongtinkhoahoc', 'tintuc', 'page'
        ))->with([
            'meta_title' => (!empty($settings['meta_title'])) ? $settings['meta_title'] : 'Giảo Cổ Lam',
            'meta_desc' => (!empty($settings['meta_desc'])) ? $settings['meta_desc'] : 'Giảo Cổ Lam',
            'meta_keywords' => (!empty($settings['meta_keywords'])) ? $settings['meta_keywords'] : 'Giảo Cổ Lam',
        ]);

    }


    public function question($slug) {

        $page = 'hoi-dap-chuyen-gia';
        $settings = Setting::lists('value', 'name');

        $question = Question::where('slug', $slug)->first();
        $related = Question::where('id', '<>', $question->id)->latest('updated_at')->limit(6)->get();


        return view('frontend.question_details', compact(
            'page',
            'question',
            'related'
        ))->with([
            'meta_title' => (!empty($settings['meta_title'])) ? $settings['meta_title'] : 'LycoEye.vn',
            'meta_desc' => (!empty($settings['meta_desc'])) ? $settings['meta_desc'] : 'LycoEye.vn',
            'meta_keywords' => (!empty($settings['meta_keywords'])) ? $settings['meta_keywords'] : 'LycoEye.vn',
        ]);

    }

    public function contact()
    {
        $page = 'contact';
        return view('frontend.contact', compact('page'))->with([
            'meta_title' => ' Liên hệ | Viemgan.com.vn ',
            'meta_desc' => '',
            'meta_keywords' => 'liên hệ',
        ]);
    }

    public function tag($keyword)
    {
        $tag = Tag::where('slug', $keyword)->first();
        $posts = $tag->posts();
        return view('frontend.search', compact('posts', 'keyword'))->with([
            'meta_title' => ' Các bài viết với nhãn '.$keyword.' tại Viemgan.com.vn ',
            'meta_desc' => '',
            'meta_keywords' => $keyword,
        ]);
    }
    public function video($value = null)
    {
        $page = 'video';

        if ($value) {
            $videoMain = Video::where('slug', $value)->first();
        } else {
            $videoMain = null;
        }

        $hotVideos = Video::where('hot', true)
            ->latest('updated_at')
            ->limit(7)
            ->get();

        $videos = Video::latest('updated_at')->paginate(10);

        return view('frontend.video', compact('page', 'hotVideos', 'videos', 'videoMain'))->with([
            'meta_title' => (!empty($settings['meta_title'])) ? $settings['meta_title'] : 'Video | Giảo Cổ Lam',
            'meta_desc' => (!empty($settings['meta_desc'])) ? $settings['meta_desc'] : 'Video Giảo Cổ Lam',
            'meta_keywords' => (!empty($settings['meta_keywords'])) ? $settings['meta_keywords'] : 'Video, Giảo Cổ Lam',
        ]);
    }

    public function product($value = null)
    {
        $page = 'san-pham';
        if (!$value) {
            $product = Product::first();

        } else {
            $product = Product::where('slug', $value)->first();
        }
        $products = Product::all();
        return view('frontend.san-pham', compact('page', 'products', 'product'))->with([
            'meta_title' => (!empty($settings['meta_title'])) ? $settings['meta_title'] : 'Sản phẩm | Giảo Cổ Lam',
            'meta_desc' => (!empty($settings['meta_desc'])) ? $settings['meta_desc'] : 'Sản phẩm Giảo Cổ Lam',
            'meta_keywords' => (!empty($settings['meta_keywords'])) ? $settings['meta_keywords'] : 'Sản phẩm, Giảo Cổ Lam',
        ]);
    }

    public function phanphoi()
    {
        $page = 'phan-phoi';
        $category = Category::where('slug', 'phan-phoi')->first();
        return view('frontend.phan-phoi', compact('page', 'category'))->with([
            'meta_title' => (!empty($settings['meta_title'])) ? $settings['meta_title'] : 'Hệ thống phân phối | Giảo Cổ Lam',
            'meta_desc' => (!empty($settings['meta_desc'])) ? $settings['meta_desc'] : 'Hệ thống phân phối Giảo Cổ Lam',
            'meta_keywords' => (!empty($settings['meta_keywords'])) ? $settings['meta_keywords'] : 'Hệ thống phân phối, Giảo Cổ Lam',
        ]);
    }

    public function lienhe()
    {
        $page = 'lien-he';
        return view('frontend.lien-he', compact('page'))->with([
            'meta_title' => (!empty($settings['meta_title'])) ? $settings['meta_title'] : 'Liên hệ | Giảo Cổ Lam',
            'meta_desc' => (!empty($settings['meta_desc'])) ? $settings['meta_desc'] : 'Liên hệ Giảo Cổ Lam',
            'meta_keywords' => (!empty($settings['meta_keywords'])) ? $settings['meta_keywords'] : 'Liên hệ, Giảo Cổ Lam',
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $posts = Post::where('title', 'LIKE', '%'.$keyword.'%')
            ->where('status', true)
            ->paginate(10);
        return view('frontend.search', compact('posts', 'keyword'))->with([
            'meta_title' => ' Các bài viết với nhãn '.$keyword.' tại Giảo Cổ Lam',
            'meta_desc' => '',
            'meta_keywords' => $keyword,
        ]);
    }

    /**
     * save contact form.
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveContact(ContactRequest $request)
    {
        Contact::create($request->all());
        return redirect('/');
    }

    public function registerEmail(RegisterEmailRequest $request)
    {
        Mail::send('emails.register', ['email' => $request->input('email')], function ($message) {
            $message->from(env('EMAIL_FROM_EMAIL'), env('EMAIL_FROM_NAME'));

            $message->to(env('EMAIL_TO_EMAIL'))
                ->cc('thienkimlove@gmail.com')
                ->subject('Email đăng ký nhận tin!');
        });
        return redirect('/');
    }

    /**
     * save question form.
     * @param ContactRequest|QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createQuestion(QuestionRequest $request)
    {
        Question::create($request->all());
        return redirect('/');
    }


    /**
     * ajax increase likes.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function increaseLikes(Request $request)
    {
        $post = Post::findOrFail($request->input('post_id'));
        $post->likes = $post->likes + 1;
        $post->save();

        return \Response::json([]);
    }

}
