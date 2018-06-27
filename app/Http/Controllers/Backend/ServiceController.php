<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communicate\Ask;
use App\Models\Service\News;
use App\Models\Service\NewsType;
use App\Models\Service\Paib;
use App\Models\Service\Physician;
use App\Models\Service\PhyType;
use App\Models\Service\Project;
use App\Models\Service\Publics;
use App\Models\Service\Store;
use App\Models\Service\storeTraffic;
use App\Models\Service\storeType;
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
    /*----------------医师部分--------------*/
    /*
     * 医师列表
     * */
    public function physicianIndex()
    {
        $data = Physician::get();
        return view('backend.service.physician.index',['data'=>$data]);
    }
    /*
     * 医师数据
     * */
    public function physicianData()
    {
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $name = $this->request->get('phy_name');
        $query = Physician::select();
        if($this->request->get('phy_name')){
            $query->where('phy_name', 'like', "%$name%");
        }
        if(access()->user()->contro!=0){
            $query->where('phy_store',access()->user()->contro);
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->orderBy('created_at','desc')->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    /*
     * 添加医师页面
     * */
    public function physicianAdd(){
        $pt = PhyType::first();
        if(empty($pt)){
            return back()->withErrors("请先添加去'<'医师职称管理'>'添加医师职称");
        }
        $store = Store::get();
        $pt = PhyType::get();
        return view('backend.service.physician.create',['store'=>$store,'pt'=>$pt]);
    }
    /*
     * 创建医师
     * */
    public function physicianCreate(){
        $req = $this->request->all();
        try{
            $phy = new Physician();
            $phy->phy_name = $req['phy_name'];
            $phy->sex = $req['sex'];
            $phy->phy_store = $req['phy_store'];
            $phy->phy_type = $req['phy_type'];
            $phy->political_face = $req['political_face'];
            $phy->phy_school = $req['phy_school'];
            $phy->education = $req['education'];
            $phy->phy_good_at = $req['phy_good_at'];
            $phy->phy_life = $req['phy_life'];
            $phy->phy_picture = $req['phy_picture'];
            $phy->educational_bg = $req['educational_bg'];
            $phy->clinical_bg = $req['clinical_bg'];
            $phy->skills = $req['skills'];
            $phy->research = $req['research'];
            $phy->research_project = $req['research_project'];
            $phy->learning = $req['learning'];
            $phy->honor = $req['honor'];
            $phy->phy_sort = 0;
            if($phy->save()){
                return redirect()->route('admin.physician.index')->withFlashSuccess('添加医师成功');
            }{
                return back()->withErrors('添加医师失败，请重新添加');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
            return back()->withErrors('添加医师失败，请重新添加');
        }
    }
    /*
     * 修改医师页面
     * */
    public function physicianUpdate($id){
        $phy = Physician::leftJoin('store','physician.phy_store','=','store.id')
            ->leftJoin('phy_type','phy_type.id','=','physician.phy_type')
            ->select('physician.*','store.store_name','phy_type.pt_name')->find($id);
        $store = Store::get();
        $pt = PhyType::get();
        return view('backend.service.physician.edit',['phy'=>$phy,'store'=>$store,'pt'=>$pt]);
    }
    /*
     * 修改医师信息
     * */
    public function physicianEdit(){
        $req = $this->request->all();
        try{
            $phy = Physician::find($req['id']);
            $phy->phy_name = $req['phy_name'];
            $phy->sex = $req['sex'];
            $phy->phy_type = $req['phy_type'];
            $phy->political_face = $req['political_face'];
            $phy->phy_school = $req['phy_school'];
            $phy->phy_store = $req['phy_store'];
            $phy->education = $req['education'];
            $phy->phy_good_at = $req['phy_good_at'];
            $phy->phy_life = $req['phy_life'];
            $phy->phy_picture = $req['phy_picture'];
            $phy->educational_bg = $req['educational_bg'];
            $phy->clinical_bg = $req['clinical_bg'];
            $phy->skills = $req['skills'];
            $phy->research = $req['research'];
            $phy->research_project = $req['research_project'];
            $phy->learning = $req['learning'];
            $phy->honor = $req['honor'];
            if($phy->save()){
                return redirect()->route('admin.physician.index')->withFlashSuccess('修改医师信息成功');
            }else{
                return back()->withErrors('修改医师信息失败，请重新提交');
            }
        }catch (Exception $e) {
            \Log::info($e->getMessage());
            return back()->withErrors('修改医师信息失败，请重新提交');

        }
    }
    /*
     * 删除医师
     * */
    public function physicianDelete(){
        $id = $this->request->input('id');
        try{
            $phy = Physician::find($id);
            if($phy->delete()){
                return return_json('',2000,'删除成功');
            }else{
                return return_err_json('删除失败',2001);
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
            return return_err_json('删除失败',2001);
        }
    }

    /**
     * 排班
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paib(){
        return view('backend.service.physician.paibindex');
    }

    public function paibdata(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $name = $this->request->get('phy_name');
        $query = Physician::select();
        if($this->request->get('name')){
            $query->where('phy_name', 'like', "%$name%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    public function createpaib($id){
        $data = Physician::find($id)->toArray();
        $data['time']=time();
        $paibinfo = Paib::where('phy_id',$id)->first();
        if($paibinfo!==null){
            $paibinfo = $paibinfo->toarray();
            $paibinfo['content']= unserialize($paibinfo['content']);
            foreach ($paibinfo['content'] as $k=>$v){
                $paibinfo['content'][$k] = explode(',',$v);
            }
            $data['paib'] = $paibinfo['content'];
        }else{
            $data['paib'] =1;
        }
        return view('backend.service.physician.paibcreate',['data'=>$data]);
    }

    /**
     *排班添加 编辑
     * @param Request $request
     * @return $this
     * @throws \Exception
     */
    public function addpaibdata(Request $request){
        $data = $request->all();
        $paib = new Paib();
        $oldpaib = $paib::where('phy_id',$data['id'])->first();
        foreach($data['times'] as $k=>$v){
            if(!empty($data['time'.$v])){
                $da[] = implode(',',$data['time'.$v]);
            }
        }
        if($oldpaib!==null){
            $oldpaib->delete();
        }
        $paib->phy_id = $data['id'];
        $paib->content = serialize($da);
        if($paib->save()){
            return redirect()->route('admin.physician.index')->withFlashSuccess('操作成功');
        }else{
            return back()->withErrors('请重新提交');
        }
//        if($oldpaib!==null){
//            $oldpaib->phy_id = $data['id'];
//            $oldpaib->content = serialize($da);
//            if($oldpaib->save()){
//                return redirect()->route('admin.paib.index')->withFlashSuccess('操作成功');
//            }else{
//                return back()->withErrors('请重新提交');
//            }
//        }else{
//            $paib->phy_id = $data['id'];
//            $paib->content = serialize($da);
//            if($paib->save()){
//                return redirect()->route('admin.paib.index')->withFlashSuccess('操作成功');
//            }else{
//                return back()->withErrors('请重新提交');
//            }
//        }

    }





    public function physicianInfo($id){
        $phy = Physician::leftJoin('store','physician.phy_store','=','store.id')
            ->leftJoin('phy_type','phy_type.id','=','physician.phy_type')
            ->select('physician.*','store.store_name','phy_type.pt_name')->find($id);
        $phy['phy_type'] = PhyType::where('id', $phy['phy_type'])->value('pt_name');
        if($phy['sex']==2){
            $phy['sex']='女';
        }else{
            $phy['sex'] ='男';
        }
        $phy['phy_store'] = Store::where('id',$phy['phy_store'])->value('store_name');
        return view('backend.service.physician.show',['phy'=>$phy]);
    }

    public function physicianHot(){
        try{
            $id = $this->request->input('id');
            $count = Physician::where('phy_sort',1)->count();
            $phy = Physician::find($id);
            if($phy->phy_sort==0){
                if($count==4){
                    return return_err_json('人气医师人数为四,请先取消其中一个后,再次设置','2003');
                }
                $phy->phy_sort = 1;
                if($phy->save()){
                    return return_json('','2000','置顶成功');
                }else{
                    return return_err_json('设置失败,请稍后再试');
                }
            }

            $phy->phy_sort = 0;
            if($phy->save()){
                return return_json('','2000','取消置顶成功');
            }else{
                return return_err_json('设置失败,请稍后再试');
            }



        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    /*----------------门店部分--------------*/
    /*
     * 门店列表
     * */
    public function storeIndex()
    {
        return view('backend.service.store.index');
    }
    /*
     * 门店数据
     * */
    public function storeData()
    {
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $name = $this->request->get('store_name');
        $query = Store::select();
        if($this->request->get('name')){
            $query->where('store_name', 'like', "%$name%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
//        foreach($list as $key=>$val){
//            $list[$key]['store_name']=storeType::where('store_position',$val['id'])->get()->values('st_name');
//        }
        return ['total' => $total, 'rows' => $list];
    }
    /*
     * 添加门店页
     * */
    public function storeAdd(){
        $st = storeType::get();
        return view('backend.service.store.create',['st'=>$st]);
    }
    /*
     * 创建门店
     * */
    public function storeCreate(){
        $req = $this->request->all();
        if(empty($req['store_pic'])){
            return back()->withErrors('请添加图片');
        }
        if(empty($req['store_traffic'])){
            return back()->withErrors('请添加地址');
        }
        DB::transaction(function () {
            $req = $this->request->all();
            $store = new Store();
            $store->store_name = $req['store_name'];
            $store->store_address = $req['store_address'];
            $store->store_intro = $req['store_intro'];
            $store->store_position = $req['store_position'];
            $store->store_tel = $req['store_tel'];
            $store->save();
            $req['store_pic'] = explode(',',$req['store_pic']);

            foreach($req['store_pic'] as $k=>$v){
                $picture = new Publics();
                $picture->public_picture = $v;
                $picture->public_id = $store->id;
                //类型1为门店照片类型
                $picture->public_type = 1;
                $picture->save();
            }

            foreach($req['store_traffic'] as $k=>$v){
                $sf = new storeTraffic();
                $sf->store_traffic = $v;
                $sf->store_id = $store->id;
                $sf->save();
            }
        });
        return redirect()->route('admin.store.index')->withFlashSuccess('添加门店成功');
    }
    /*
     * 修改门店
     * */
    public function storeUpdate($id){
        $store = Store::join('store_type','store.store_position','=','store_type.id')->select('store.*','store_type.st_name')->find($id);
        $st = storeType::get();
        $store->public = Publics::where('public_type',1)->where('public_id',$id)->get();
        $addId = $this->request->input('addId');
        $add = '';
        if($this->request->input('addId')){
            $add = storeTraffic::find($addId);
            $store->sf = $add->store_traffic;
            $store->sd = $add->id;
        }else{
            $store->sf = '';
            $store->sd = '';
        }
        $store->traffic = storeTraffic::where('store_id',$id)->get();
        return view('backend.service.store.edit',['store'=>$store,'st'=>$st,'add'=>$add]);
    }

    public function trafficEdit(){
        $req = $this->request->all();
        $sf = storeTraffic::find($req['id']);
        $sf->store_traffic = $req['sf'];
        if($sf->save()){
            return return_json();
        }
    }

    public function trafficCreate(){
        try{
            $req = $this->request->all();
           $sf = new storeTraffic();
           $sf->store_id = $req['fd'];
           $sf->store_traffic = $req['sf'];
           if($sf->save()){
               return return_json();
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }
    public function trafficDelete(){
        try{
            $id = $this->request->input('id');
           $sf = storeTraffic::find($id);
           if($sf->delete()){
               return return_json();
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }
    /*
     * 修改门店
     */
    public function storeEdit(){
        DB::transaction(function () {
            $req = $this->request->all();
            $store = Store::find($req['id']);
            $store->store_name = $req['store_name'];
            $store->store_address = $req['store_address'];
            $store->store_intro = $req['store_intro'];
            $store->store_position = $req['store_position'];
            $store->store_tel = $req['store_tel'];
            $store->store_name = $req['store_name'];
            $store->save();
            //删除旧照片
            if($req['old_public']){
                $req['old_public'] = explode(',',$req['old_public']);
                foreach($req['old_public'] as $k=>$v){
                    $public = Publics::find($v);
                    $public->delete();
                }
            }
            //添加新照片
            if($req['new_public']){
                $req['new_public'] = explode(',',$req['new_public']);
                foreach($req['new_public'] as $k=>$v){
                    $public = new Publics();
                    $public->public_picture = $v;
                    $public->public_id = $req['id'];
                    $public->public_type = 1;
                    $public->save();
                }
            }
        });
        return redirect()->route('admin.store.index');
    }
    /*
     * 删除门店
     */
    public function storeDelete(){
        try{
            $id = $this->request->input('id');
            $phy = Physician::where('phy_store',$id)->first();
            if($phy){
                return return_err_json('删除失败','2001');
            }
            DB::transaction(function () {
                $ids = $this->request->input('id');
                $store = Store::find($ids);
                $store->delete();
                Publics::where('public_id',$ids)->delete();

                storeTraffic::where('store_id',$ids)->delete();
            });
            return return_json('',2000);
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function storeInfo($id){
        $store = Store::find($id);
        $store->public = Publics::where('public_type',1)->where('public_id',$id)->get();
        $store->traffic = storeTraffic::where('store_id',$id)->get();
        return view('backend.service.store.show',['store'=>$store]);
    }

    /*---------------服务项目部分-----------------*/
    /*
     * 服务项目首页
     */
    public function projectIndex(){
        return view('backend.service.project.index');
    }
    /*
     * 服务项目数据
     */
    public function projectData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        //$name = $this->request->get('phy_name');
        $query = Project::select();
        /*if($this->request->get('name')){
            $query->where('phy_name', 'like', "%$name%");
        }*/
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    /*
     * 新建服务项目
     */
    public function projectAdd(){
        return view('backend.service.project.create');
    }
    /*
     * 新建
     */
    public function projectCreate(){
        try{
            $req = $this->request->all();
            $project = new Project();
            $project->project_name = $req['project_name'];
            $project->project_type = $req['project_type'];
            $project->project_intro = $req['project_intro'];
            if($project->save()){
                return redirect()->route('admin.project.index')->withFlashSuccess('创建服务项目成功');
            }else{
                return back()->withErrors('创建服务项目失败,请稍后重试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }
    /*
     * 修改服务项目
     */
    public function projectUpdate($id){
       $project = Project::find($id);
       return view('backend.service.project.edit',['project'=>$project]);
    }
    /*
     * 修改
     */
    public function projectEdit(){
        try{
            $req = $this->request->all();
           $project = Project::find($req['id']);
           $project->project_name = $req['project_name'];
           $project->project_intro = $req['project_intro'];
           $project->project_type = $req['project_type'];
           if($project->save()){
               return redirect()->route('admin.project.index')->withFlashSuccess('修改服务项目成功');
           }else{
               return back()->withErrors('修改服务项目失败，请稍后重试');
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }
    /*
     * 删除服务项目
     */
    public function projectDelete(){
        try{
            $id = $this->request->input('id');
            $project = Project::find($id);
            if($project->delete()){
                return return_json('',2000);
            }else{
                return return_err_json('失败',2001);
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function projectInfo($id){
        $project = Project::find($id);
        return view('backend.service.project.show',['project'=>$project]);
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
           $req = $this->request->input('nt_name');
           $nt = new NewsType();
           $nt->nt_name = $req;
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
            $nt->nt_name = $req['nt_name'];
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
            ->select('news.*','news_type.nt_name');
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
            $news->news_intro = $req['news_intro'];
            $news->news_time = $req['news_time'];
            $news->news_content = $req['news_content'];
            $news->agent = $req['agent'];
            $news->agent_status = $req['agent_status'];
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
                ->select('news.*','news_type.nt_name')->find($id);
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
            $news->news_intro = $req['news_intro'];
            $news->news_content = $req['news_content'];
            $news->agent = $req['agent'];
            $news->agent_status = $req['agent_status'];
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
            ->select('news.*','news_type.nt_name')->find($id);
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

    /*--------------医师职称----------------*/
    public function phyTypeIndex(){
        return view('backend.service.phytype.index');
    }

    public function phyTypeData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        //$name = $this->request->get('phy_name');
        $query = PhyType::select();
        /*if($this->request->get('name')){
            $query->where('phy_name', 'like', "%$name%");
        }*/
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function phyTypeAdd(){
        return view('backend.service.phytype.create');
    }

    public function phyTypeCreate(){
        try{
            $name = $this->request->input('pt_name');
            $pt = new PhyType();
            $pt->pt_name = $name;
            if($pt->save()){
                return redirect()->route('admin.phy_type.index')->withFlashSuccess('创建医师职称成功');
            }else{
                return back()->withErrors('创建失败,请稍后再试');
            }
        }catch(Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function phytypeUpdate($id){
        $pt = PhyType::find($id);
        return view('backend.service.phytype.edit',['pt'=>$pt]);
    }

    public function phyTypeEdit(){
        try{
            $req = $this->request->all();
           $pt = PhyType::find($req['id']);
           $pt->pt_name = $req['pt_name'];
           if($pt->save()){
               return redirect()->route('admin.phy_type.index')->withFlashSuccess('修改医师职称成功');
           }else{
                return back()->withErrors('修改失败,请稍后再试');
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function phyTypeDelete(){
        try{
            $id = $this->request->input('id');
            $news = Physician::where('phy_type',$id)->first();
            if(!empty($news)){
                return return_err_json('此医师职称下有医师,请先清除医师再试','2001');
            }
            $nt = PhyType::find($id);
            if($nt->delete()){
                return return_json();
            }else{
                return return_err_json('请稍后再试','2001');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function storeTypeIndex(){
        return view('backend.service.storetype.index');
    }

    public function storeTypeData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $type = $this->request->get('type');
        $query = storeType::select();
        if($this->request->get('type')){
            $query->where('news_type', '=', $type);
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function storeTypeAdd(){
        return view('backend.service.storetype.create');
    }

    public function storeTypeCreate(){
        try{
            $req = $this->request->all();
            $st = new storeType();
            $st->st_name = $req['st_name'];
            if($st->save()){
                return redirect()->route('admin.store_type.index')->withFlashSuccess('创建成功');
            }else{
                return back()->withErrors('创建失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function storeTypeUpdate($id){
        $st = storeType::find($id);
        return view('backend.service.storetype.edit',['st'=>$st]);
    }

    public function storeTypeEdit(){
        try{
            $req = $this->request->all();
            $st = storeType::find($req['id']);
            $st->st_name = $req['st_name'];
            if($st->save()){
                return redirect()->route('admin.store_type.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function storeTypeDelete(){
        try{
            $id = $this->request->input('id');
            $st = storeType::find($id);
            if($st->delete()){
                return return_json();
            }else{
                return return_err_json();
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    /**
     * 特色案例
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  teser(){
        $data = News::where('news_type',6)->select('id','news_title')->get();
        return  view('backend.service.teser.index',['data'=>$data]);
    }
    public function teserdata(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $type = $this->request->get('type');
        $name = $this->request->get('name');
        $query = News::join('news_type','news.news_type','=','news_type.id')->orderBy('created_at','desc')
            ->select('news.*','news_type.nt_name');
        if($this->request->get('name')){
            $query->where('news_type', '=', 6);
            $query->where('news_title', 'like', "%$name%");
        }else{
            $query->where('news_type', '=', 6)->where('news_top',1);
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
//        dd($list);
        return ['total' => $total, 'rows' => $list];

    }

    /**
     * 媒体查询
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function media(){
        $data = News::where('news_type',10)->select('id','news_title')->get();
        return  view('backend.service.media.index',['data'=>$data]);
    }
    public function mediadata(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $type = $this->request->get('type');
        $name = $this->request->get('name');
        $query = News::join('news_type','news.news_type','=','news_type.id')->orderBy('created_at','desc')
            ->select('news.*','news_type.nt_name');
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

    /**
     * 人气医师
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function physhot(){
        $data = Physician::select('id','phy_name')->get();
        return  view('backend.service.physhot.index',['data'=>$data]);
    }
    public function physhotdata(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $name = $this->request->get('name');
        $query = Physician::where('phy_sort',1)->select();
        if($this->request->get('name')){
            $query->where('phy_name', 'like', "%$name%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    /**
     * 解疑服务
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function problem(){
        $data = Ask::select('id','ask_title')->get();
        return  view('backend.service.problem.index',['data'=>$data]);
    }
    public function problemdata(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $name = $this->request->get('name');
        $query = Ask::where('ask_hot',1)->select();
        if($this->request->get('name')){
            $query->where('ask_title', 'like', "%$name%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
}


