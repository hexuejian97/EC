<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/5/16
 * Time: 14:41
 */

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service\Optometry;
class VideoController extends Controller
{
    /**
     * 视频空间页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('backend.service.video.index');
    }

    /**
     * 列表数据
     * @param Request $request
     * @return array
     */
    public function getdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = Optometry::where('type',3)->select();
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    /**
     * 添加视频空间数据
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        if($request->isMethod('post')){
            $opto = new Optometry();
            $opto->title = $request->input('title');
            $opto->intro = $request->input('intro');
            $opto->type = 3;
            $opto->created_at = date('Y-m-d H:i:s');
            if($opto->save()){
                return redirect()->route('admin.video.index')->withFlashSuccess('添加成功');
            }else{
                return back()->withErrors('添加医师失败，请重新添加');
            }
        }
        return view('backend.service.video.create');
    }

    /**
     * 查看详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id){
        $data = Optometry::find($id);
        return view('backend.service.video.show',['special'=>$data]);
    }

    /**
     * 修改数据
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id){
        $data = Optometry::find($id);
        return view('backend.service.video.edit',['special'=>$data]);
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
        if($data->save()){
            return redirect()->route('admin.video.index')->withFlashSuccess('修改成功');
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