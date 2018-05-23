<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/5/17
 * Time: 9:18
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service\ServiceProject;
use App\Models\Service\ServiceMenu;
class CharacteristicProjectController extends Controller
{
    public function index(Request $request){
        return view('backend.service.characterproject.index');
    }
    /**
     * 列表数据
     * @param Request $request
     * @return array
     */
    public function getdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = ServiceProject::where('type',2)->select();
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        foreach($list as $k=>$v){
            if($v['prent_id']==0){
                $list[$k]['prent_id']='顶级菜单';
            }else{
                $list[$k]['prent_id'] = ServiceMenu::find($v['prent_id'])['name'];
            }
        }
        return ['total' => $total, 'rows' => $list];
    }
    /**
     * 添加数据
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        if($request->isMethod('post')){
            $opto = new ServiceProject();
            $opto->title = $request->input('title');
            $opto->content = $request->input('content');
            $opto->prent_id = $request->input('parnt');
            $opto->intro = $request->input('intro');
            $opto->type = 2;
            $opto->created_at = date('Y-m-d H:i:s');
            if($opto->save()){
                return redirect()->route('admin.characteristic_project.index')->withFlashSuccess('添加成功');
            }else{
                return back()->withErrors('添加医师失败，请重新添加');
            }
        }
        $dat = ServiceMenu::where('type',2)->where('prent_id',0)->get()->toArray();
        return view('backend.service.characterproject.create',['menu'=>$dat]);
    }
    /**
     * 查看详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id){
        $data = ServiceProject::find($id);
        $data['prent_id'] = ServiceMenu::find($data['prent_id'])['name'];
        return view('backend.service.characterproject.show',['project'=>$data]);
    }
    /**
     * 修改数据
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id){
        $data = ServiceProject::find($id);
        $menu = ServiceMenu::where('type',2)->where('prent_id',0)->get()->toArray();
        $dat = $this->gettree($menu,0);
        return view('backend.service.characterproject.edit',['project'=>$data,'menu'=>$dat]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request){
        $data = ServiceProject::find($request->input('id'));
        $data->title = $request->input('title');
        $data->intro =$request->input('intro');
        $data->prent_id = $request->input('parnt');
        $data->content =$request->input('content');
//        dd($data);
        if($data->save()){
            return redirect()->route('admin.characteristic_project.index')->withFlashSuccess('修改成功');
        }else{
            return back()->withErrors('修改失败,请稍后再试');
        }
    }
    /**
     * 删除
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function delopty(Request $request){
        $opto = new ServiceProject();
        $optoinfo = $opto->find($request->input('id'));
        if($optoinfo->delete()){
            return return_json();
        }else{
            return return_err_json('请稍后再试','2001');
        }
    }

}