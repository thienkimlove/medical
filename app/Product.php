<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
        'unique'          => true,
        'on_update'       => true,
    );


    protected $fillable = [
        'title',
        'slug',
        'thongtin',
        'nghiencuu',
        'image'
    ];

    public function getRelated1Attribute()
    {
        return Post::whereHas('modules', function($q){
            $q->where('slug', 'thong-tin-san-pham-'.$this->id)
                ->orderBy('order');
        })->where('status', true)
            ->limit(6)
            ->get();
    }

    public function getRelated2Attribute()
    {
        return Post::whereHas('modules', function($q){
            $q->where('slug', 'nghien-cuu-san-pham-'.$this->id)
                ->orderBy('order');
        })->where('status', true)
            ->limit(6)
            ->get();
    }

    public function hotVideos()
    {
        return $this->hasMany('App\Video')
            ->where('hot', true)
            ->latest('updated_at');
    }

    public function getVlistAttribute()
    {
        return $this->hasMany('App\Video')
            ->latest('updated_at')
            ->paginate(6);
    }
}
