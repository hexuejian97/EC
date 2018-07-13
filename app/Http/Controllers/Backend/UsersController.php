<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/7/2
 * Time: 10:20
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Service\Users;
use Illuminate\Http\Request;
class UsersController extends Controller
{
    public function index(){
        $user = Users::get();
        return view('backend.service.users.index',['data'=>$user]);
    }
    public function getdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $where = $request->input('name');
        $query = Users::select();
        if(!empty($where)){
            $query->where('user_name', 'like', "%$where%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->orderBy('created_at','desc')->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
    /**
     * 查看详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id){
        $data = Users::find($id);
        return view('backend.service.users.show',['product'=>$data]);
    }
    /**
     * 删除
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function delopty(Request $request){
        $opto = new Users();
        $optoinfo = $opto->find($request->input('id'));
        if($optoinfo->delete()){
            return return_json();
        }else{
            return return_err_json('请稍后再试','2001');
        }
    }
}