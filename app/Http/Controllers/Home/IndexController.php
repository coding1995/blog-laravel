<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Link;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use XS;

class IndexController extends CommentController
{
    //显示首页
    public function index()
    {
     /*Redis::set('11','11');
     dd(Redis::get('11'));*/
        //点击量最多的6篇文章（推荐栏）
        $hot = Article::orderBy('art_view', 'desc')->take(4)->get();
        //图文列表和分页
        $data = Article::orderBy('art_time', 'desc')->take(6)->get();
        //dd($data);
        // $res = Article::take(6)->get();
        // dd($res);
        //友情链接
        $link = Link::orderBy('link_order', 'desc')->get();
        //dd($link);
        //配置项SEO优化
        //查询分类
        $Category = Category::where('cate_pid', '=', 0)->orderBy('cate_id')->get();
        // dd($Category);
        foreach ($Category as $key => $value) {
            $Category[$key]->cate = Category::where('cate_pid', '=', $value->cate_id)->get(); 
        }
        // dd($Category[3]['cate'][0]);
        //继承comment里面共享navs到所有页面
        return view('home/index', compact('hot', 'data',  'link', 'Category'));
    }

    //显示列表页
    public function cate(Request $request, $cate_id)
    {
        if ( $request->isMethod('post') ) {
            
            $keyword = $request->input('keywords');//获取关键字
            // $xs = new \XS(config_path('blog_article.ini'));
            // dd(config_path('blog_article.ini'));
            $xs = new XS(config_path('blog_article.ini'));
            //获取搜索对象
            $search = $xs->search;

            $res = $search->setFuzzy()->search($keyword);
            echo "<pre>";
            var_dump($res);

        } else {


        $cateData = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(4);
          /* Redis::hSet("articlelist:$cate_id",'articlelist', json_encode($data));*/
        $Category = Category::where('cate_pid', '=', 0)->orderBy('cate_id')->get();
        // dd($Category);
        foreach ($Category as $key => $value) {
            $Category[$key]->cate = Category::where('cate_pid', '=', $value->cate_id)->get(); 
        }

       
        $hot = Article::orderBy('art_view', 'desc')->take(4)->get();
        //图文列表和分页
        $data = Article::orderBy('art_time', 'desc')->take(6)->get();

     
        return view('home/list', compact('Category', 'hot', 'data', 'cateData'));
        }
    }

    //显示文章页
    public function article($art_id)
    {
        //echo $art_id;
        $field = Article::where('art_id', '=' ,$art_id)->first();


        $Category = Category::where('cate_pid', '=', 0)->orderBy('cate_id')->get();
        // dd($Category);
        foreach ($Category as $key => $value) {
            $Category[$key]->cate = Category::where('cate_pid', '=', $value->cate_id)->get(); 
        }

       
        $hot = Article::orderBy('art_view', 'desc')->take(4)->get();
        //图文列表和分页
        $datacate = Article::orderBy('art_time', 'desc')->take(6)->get();
        //dd($field);
        //上一篇，下一篇
        $article['pre'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        //查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
        //相关文章
        if(Redis::exists("article:$art_id")){
           echo '查缓存';
           $data = Redis::hGet("article:$art_id", "article");
           $data = json_decode($data);
            // $data = $arr->data;
        }else{
            $data = Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();
           Redis::hSet("article:$art_id",'article', json_encode($data));
       }
        // dd($article);
        // dd($field);
        return view('home/new', compact('field', 'article', 'data', 'Category', 'hot', 'datacate'));
    }



}
