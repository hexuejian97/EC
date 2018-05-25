<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/5/17
 * Time: 11:08
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Service\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index(){
        return view('backend.service.product.index');
    }
    /**
     * 列表数据
     * @param Request $request
     * @return array
     */
    public function getdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = Product::select();
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
            $opto = new Product();
            $opto->title = $request->input('title');
            $opto->content = $request->input('content');
            $opto->url = $request->input('url');
            $opto->created_at = date('Y-m-d H:i:s');
            if($opto->save()){
                return redirect()->route('admin.product.index')->withFlashSuccess('添加成功');
            }else{
                return back()->withErrors('添加医师失败，请重新添加');
            }
        }
        return view('backend.service.product.create');
    }
    /**
     * 查看详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id){
        $data = Product::find($id);
        return view('backend.service.product.show',['product'=>$data]);
    }
    /**
     * 修改数据
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id){
        $data = Product::find($id);
        return view('backend.service.product.edit',['product'=>$data]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request){
        $data = Product::find($request->input('id'));
        $data->title = $request->input('title');
        $data->content =$request->input('content');
        $data->url =$request->input('url');
        if($data->save()){
            return redirect()->route('admin.product.index')->withFlashSuccess('修改成功');
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
        $opto = new Product();
        $optoinfo = $opto->find($request->input('id'));
        if($optoinfo->delete()){
            return return_json();
        }else{
            return return_err_json('请稍后再试','2001');
        }
    }

}