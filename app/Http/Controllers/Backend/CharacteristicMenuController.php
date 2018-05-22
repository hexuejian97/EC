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
use App\Models\Service\ServiceMenu;

class CharacteristicMenuController extends Controller
{
    public function index(){
        return view('backend.service.charactermenu.index');
    }
    /**
     * 列表数据
     * @param Request $request
     * @return array
     */
    public function getdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = ServiceMenu::where('type',2)->select();
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    /**
     * 添加数据
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        if($request->isMethod('post')){
            $opto = new ServiceMenu();
            $opto->name = $request->input('name');
            $opto->prent_id = $request->input('parnt');
            $opto->type = 2;
            if($opto->save()){
                return redirect()->route('admin.characteristic_menu.index')->withFlashSuccess('添加成功');
            }else{
                return back()->withErrors('添加医师失败，请重新添加');
            }
        }
        $data = ServiceMenu::where(['type'=>2,'prent_id'=>0])->get();

        return view('backend.service.charactermenu.create',['menu'=>$data]);
    }
    /**
     * 查看详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id){
        $data = ServiceMenu::find($id);
        return view('backend.service.charactermenu.show',['menu'=>$data]);
    }
    /**
     * 修改数据
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id){
        $data = ServiceMenu::find($id);
        $menu = ServiceMenu::where(['type'=>2,'prent_id'=>0])->get();
        return view('backend.service.charactermenu.edit',['menu'=>$data,'datamenu'=>$menu]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request){
        $data = ServiceMenu::find($request->input('id'));
        $data->name = $request->input('name');
        if($request->input('id')==$request->input('parnt')){
            $data->prent_id = 0;
        }else{
            $data->prent_id = $request->input('parnt');
        }
        if($data->save()){
            return redirect()->route('admin.characteristic_menu.index')->withFlashSuccess('修改成功');
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
        $opto = new ServiceMenu();
        $optoinfo = $opto->find($request->input('id'));
        if($optoinfo->delete()){
            return return_json();
        }else{
            return return_err_json('请稍后再试','2001');
        }
    }

}