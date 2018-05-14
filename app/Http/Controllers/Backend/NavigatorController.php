<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Communicate\Nav;
use App\Models\Service\Project;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class LanguageController.
 */
class NavigatorController extends Controller
{
    /**
     * @param $lang
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function firstIndex()
    {
        $nav = Nav::where('nav_pid',0)->get();
        foreach($nav as $k=>$v){
            $nav[$k]['son'] = Nav::where('nav_pid',$v->id)->get();
        }
        return view('backend.nav.first.index',['nav'=>$nav]);
    }


    public function firstAdd(){
        return view('backend.nav.first.create');
    }

    public function firstCreate(){
        try{
            $req = $this->request->input('nav_name');
            $nav = new Nav();
            $nav->nav_name = $req;
            $nav->nav_pid = 0;
            if($nav->save()){
                return redirect()->route('admin.first.index')->withFlashSuccess('创建一级导航成功');
            }else{
                return back()->withErrors('创建失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function firstUpdate($id){
       $nav = Nav::find($id);
       return view('backend.nav.first.edit',['nav'=>$nav]);
    }

    public function firstEdit(){
        try{
            $req = $this->request->all();
            $nav = Nav::find($req['id']);
            $nav->nav_name = $req['nav_name'];
            if($nav->save()){
                return redirect()->route('admin.first.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \log::info($e->getMessage());
        }

        return view('backend.nav.first.edit',['nav'=>$nav]);
    }

    public function firstDelete(){
        try{
           $id = $this->request->input('id');
           $nav_p = Nav::where('nav_pid',$id)->first();
           if(!empty($nav_p)){
               return return_err_json('请先删除子菜单后再操作此菜单','2001');
           }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }


    public function secondAdd($id){
        $nav = Nav::find($id);
        if($id== '6' || $id == '10'){
            $project = Project::where('project_type',$nav->nav_name)->get();
            return view('backend.nav.second.create',['nav'=>$nav,'pro'=>$project]);
        }
        if($id == '8'){

        }

        return back()->withErrors('此导航暂时不能加子菜单');

    }

    public function secondCreate(){
        try{

            $req = $this->request->all();
            if($req['pid']=='6' || $req['pid']=='10'){
                $pro = Project::find($req['link']);
                $nav = new Nav();
                $nav->nav_pid = $req['pid'];
                $nav->nav_name = $pro->project_name;
                $nav->nav_link = $pro->id;
                if($nav->save()){
                    return redirect()->route('admin.first.index')->withFlashSuccess('创建二级目录成功');
                }else{
                    return back()->withErrors('创建失败,请稍后再试');
                }
            }
            if($req['pid']=='8'){

            }

        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function secondUpdate($id){
        $nav = Nav::find($id);
        $navf = Nav::where('id',$nav->nav_pid)->first();
        return view('backend.nav.second.edit',['nav'=>$nav,'navf'=>$navf]);
    }

    public function secondEdit(){
        try{
            $req = $this->request->all();
            $nav = Nav::find($req['id']);
            $nav->nav_name = $req['nav_name'];
            if($nav->save()){
                return redirect()->route('admin.first.index')->withFlashSuccess('修改二级目录成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::infp($e->getMessage());
        }
    }

    public function secondDelete(){
        try{
            $id = $this->request->input('id');
            $nav = Nav::find($id);
            if($nav->delete()){
                return return_json();
            }else{
                return return_err_json('请稍后再试');
            }

        }catch (Exception $e){
            \Log::infp($e->getMessage());
        }
    }


}
