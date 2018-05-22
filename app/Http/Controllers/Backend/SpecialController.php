<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/5/15
 * Time: 12:48
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Service\Optometry;
use Illuminate\Http\Request;

class SpecialController extends Controller
{
    /**
     * 特色技术页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('backend.service.special.index');
    }

    /**
     * 列表数据
     * @param Request $request
     * @return array
     */
    public function getdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = Optometry::where('type',2)->select();
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    /**
     * 添加特色技术数据
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        if($request->isMethod('post')){
            $opto = new Optometry();
            $opto->title = $request->input('title');
            $opto->content = $request->input('content');
            $opto->intro = $request->input('intro');
            $opto->type = 2;
            $opto->created_at = date('Y-m-d H:i:s');
            if($opto->save()){
                return redirect()->route('admin.special.index')->withFlashSuccess('添加成功');
            }else{
                return back()->withErrors('添加医师失败，请重新添加');
            }
        }
        return view('backend.service.special.create');
    }

    /**
     * 查看详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id){
        $data = Optometry::find($id);
        return view('backend.service.special.show',['special'=>$data]);
    }

    /**
     * 修改数据
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id){
        $data = Optometry::find($id);
        return view('backend.service.special.edit',['special'=>$data]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request){
        $data = Optometry::find($request->input('id'));
        $data->title = $request->input('title');
        $data->intro =$request->input('intro');
        $data->content =$request->input('content');
        if($data->save()){
            return redirect()->route('admin.special.index')->withFlashSuccess('修改成功');
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
        $opto = new Optometry();
        $optoinfo = $opto->find($request->input('id'));
        if($optoinfo->delete()){
            return return_json();
        }else{
            return return_err_json('请稍后再试','2001');
        }
    }

}