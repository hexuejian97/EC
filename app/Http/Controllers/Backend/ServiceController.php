<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Service\News;
use App\Models\Service\NewsType;

use App\Models\Service\Publics;
use Illuminate\Http\Request;
use Mockery\Exception;
use DB;
require_once app_path('../vendor/autoload.php');
use Qiniu\Auth;

/**
 * Class DashboardController.
 */
class ServiceController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    //生成token
    public function upToken(){
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = '59jduPphUtEg2MX5csuao09VU3T2l8cjBfM4mFdr';
        $secretKey = 'iB-_d3fzBiITQrMj5hPedHt5lJwUvVzJYBrNIib6';
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 要上传的空间
        $bucket = 'eyehospital';
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        return $token;
    }

    /*--------------新闻资讯类型----------------*/
    /*
     * 新闻资讯类型首页
     */
    public function newsTypeIndex(){
        return view('backend.service.newstype.index');
    }

    public function newsTypeData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        //$name = $this->request->get('phy_name');
        $query = NewsType::select();
        /*if($this->request->get('name')){
            $query->where('phy_name', 'like', "%$name%");
        }*/
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function newsTypeAdd(){
        return view('backend.service.newstype.create');
    }

    public function newsTypeCreate(){
        try{
           $req = $this->request->input('news_type');
           $nt = new NewsType();
           $nt->news_type = $req;
           if($nt->save()){
               return redirect()->route('admin.news_type.index')->withFlashSuccess('创建新闻类型成功');
           }else{
               return back()->withErrors('添加失败,请稍后再试');
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function newsTypeUpdate($id){
        $nt = NewsType::find($id);
        return view('backend.service.newstype.edit',['nt'=>$nt]);
    }

    public function newsTypeEdit(){
        try{
            $req = $this->request->all();
            $nt = NewsType::find($req['id']);
            $nt->news_type = $req['news_type'];
            if($nt->save()){
                return redirect()->route('admin.news_type.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function newsTypeDelete(){
        try{
            $id = $this->request->input('id');
            $news = News::where('news_type',$id)->first();
            if(!empty($news)){
                return return_err_json('此资讯类型下有文章,请先清除文章再试','2001');
            }
            $nt = NewsType::find($id);
            if($nt->delete()){
                return return_json();
            }else{
                return return_err_json('请稍后再试','2001');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    /*--------------新闻资讯----------------*/
    /*
     * 新闻首页
     */
    public function newsIndex(){
        $nt = NewsType::get();
        return view('backend.service.news.index',['nt'=>$nt]);
    }

    /*
     * 新闻数据
     */
    public function newsData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $type = $this->request->get('name');
        $query = News::join('news_type','news.news_type','=','news_type.id')->orderBy('created_at','desc')
            ->select('news.*','news_type.type_name');
        if($this->request->get('name')){
            $query->where('news_type', $type);
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    /*
     * 新建新闻
     */
    public function newsAdd(){
        $newstype = NewsType::first();
        if(empty($newstype)){
            return back()->withErrors("请先去<'新闻资讯类型'>管理添加新闻类型");
        }
        $nt = NewsType::get();
        return view('backend.service.news.create',['nt'=>$nt]);
    }

    public function newsCreate(){
        try{
            $req = $this->request->all();
            $news = new News();
            $news->news_title = $req['news_title'];
            $news->news_type = $req['news_type'];
            $news->news_picture = $req['news_picture'];
            $news->news_time = $req['news_time'];
            $news->news_content = $req['news_content'];
            $news->publisher=$req['publisher'];

            if($news->save()){
                return redirect()->route('admin.news.index')->withFlashSuccess('创建新闻资讯成功');
            }else{
                return back()->withErrors('创建失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function newsUpdate($id){
        try{
            $news = News::join('news_type','news.news_type','=','news_type.id')
                ->select('news.*','news_type.type_name')->find($id);
             $nt = NewsType::get();
             return view('backend.service.news.edit',['news'=>$news,'nt'=>$nt]);
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function newsEdit(){
        try{
            $req = $this->request->all();
            $news = News::find($req['id']);
            $news->news_title = $req['news_title'];
            $news->news_time = $req['news_time'];
            $news->news_picture = $req['news_picture'];
            $news->news_type = $req['news_type'];
            $news->news_content = $req['news_content'];
            $news->publisher=$req['publisher'];
            if($news->save()){
                return redirect()->route('admin.news.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch(Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function newsDelete(){
        try{
            $id = $this->request->input('id');
            $news = News::find($id);
            if($news->delete()){
                return return_json();
            }else{
                return return_err_json('删除失败','2001');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function newsInfo($id){
        $news = News::join('news_type','news.news_type','=','news_type.id')
            ->select('news.*','news_type.type_name')->find($id);
        return view('backend.service.news.show',['news'=>$news]);
    }

    /**
     * 新闻置顶
     * @return array
     */
    public function newsTop(){
        try{
           $id = $this->request->input('id');
           $news = News::find($id);
           echo var_dump($id);
           if($news->news_type == 10 && $news->news_top == 0){
               $newss = News::where([
                   ['news_type', '=', '10'],
                   ['news_top', '=', '1'],
               ])->first();
               if(!empty($newss)){
                   $dnews = News::find($newss->id);
                   $dnews->news_top=0;
                   $dnews->save();
               }
               $news->news_top = 1;
               $news->save();
               return return_json('','2000','新闻报道置顶成功');
           }else if($news->news_type == 10 && $news->news_top == 1){
               $news->news_top = 0;
               $news->save();
               return return_json('','2000','新闻报道取消置顶成功');
           }

           if($news->news_type== 6 && $news->news_top == 0){
                $count = News::where([
                    ['news_type', '=', '6'],
                    ['news_top', '=', '1'],
                ])->count();
                if($count==2){
                    return return_err_json('已有两个置顶,请先取消','2001');
                }else{
                    $news->news_top = 1;
                    $news->save();
                    return return_json('病例分享置顶成功');
                }
           }else if($news->news_type== 6 && $news->news_top == 1){
               $news->news_top = 0;
               $news->save();
               return return_json('病例分享取消置顶成功');
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }



    /**
     * 媒体查询
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newtop(){
        $data = News::where('news_type',10)->select('id','news_title')->get();
        return  view('backend.communicate.newtop.index',['data'=>$data]);
    }
    public function newtopdata(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $type = $this->request->get('type');
        $name = $this->request->get('name');
        $query = News::join('news_type','news.news_type','=','news_type.id')->orderBy('created_at','desc')
            ->select('news.*','news_type.news_type');
        $query->where('news_type', '=', 10)->where('news_top',1);
        if($this->request->get('name')){
            $query->where('news_title', 'like', "%$name%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];

    }




    /*
    *最新活动管理
    */
    public function latestnewsIndex(){
        return view('backend.communicate.latestnews.index');
    }

    public function latestnewsData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $query = News::select('news_title');
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    public function latestnewsUpdate($id){
        $hot = News::find($id);
        return view('backend.communicate.latestnews.edit',['hot'=>$hot]);
    }

    public function latestnewsEdit(){
        try{
            $req = $this->request->all();
            $hot = News::find($req['id']);
            $hot->hot_title = $req['title'];
            $hot->hot_link = $req['link'];
            $hot->hot_picture = $req['picture'];
            if($hot->save()){
                return redirect()->route('admin.latestnews.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }
}


