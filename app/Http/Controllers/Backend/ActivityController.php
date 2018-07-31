<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/5/29
 * Time: 10:26
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;

use App\Models\Service\Activity;
use Illuminate\Http\Request;
use Mockery\Exception;
/*use DB;
require_once app_path('../vendor/autoload.php');
use Qiniu\Auth;
*/
class activityController extends Controller
{
public function activityIndex(){
    $act=new Activity();
        return view('backend.service.activity.index');
    }
   public function activitygetdata(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = Activity::select('id','act_title','act_picture','act_link','act_status','act_setime');
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }
     public function activityAdd(){
        $act=new Activity();
        return view('backend.service.activity.create',['act'=>$act]);
    }

    public function activityCreate(Request $request){

            $req = $request->all();
            $act = new Activity();
            $act->act_title = $req['act_title'];

            $act->act_picture = $req['act_picture'];
            $act->act_setime = $req['act_stime'].'至'.$req['act_etime'];
            $act->act_stime=$req['act_stime'];
            $act->act_etime=$req['act_etime'];
            $act->act_link=$req['act_link'];
            if(date($req['act_etime'])<date(Y-m-d)){
                $act->act_status = '已结束';
            }
            if(date($req['act_etime'])===date(Y-m-d)){
                $act->act_status = '进行中';
            }
           /* if(date($req['act_stime'])>date(Y-m-d))
            {
                $act->act_status = '未开始';
            ｝*/

            if($act->save()){
                return redirect()->route('admin.activity.index')->withFlashSuccess('创建活动成功');
            }else{
                return back()->withErrors('创建失败,请稍后再试');
            }

    }

    public function activityUpdate($id){
            $act=Activity::find($id);
             return view('backend.service.activity.edit',['act'=>$act]);

    }

    public function activityEdit(Request $request){
try{

            $act = Activity::find($request->input('id'));
         //   echo var_dump($act);
            $act->act_title = $request->input('act_title');

            $act->act_picture = $request->input('act_picture');
            $act->act_setime = $request->input('act_stime').'至'.$request->input('act_etime');
            $act->act_stime=$request->input('act_stime');
            $act->act_etime=$request->input('act_etime');
            $act->act_link=$request->input('act_link');
            if($act->save()){
                return redirect()->route('admin.activity.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }

    }catch(Exception $e){
            \Log::info($e->getMessage());
            return back()->withErrors('修改问题失败,请稍后再试');

        }
}
    public function activityDelete(Request $request){

            //$act=new Activity();
            $actinfo = Activity::find($request->input('id'));
            if($actinfo->delete()){
                return return_json();
            }else{
                return return_err_json('删除失败','2001');
            }

    }

    public function activityInfo($id){
        $act = Activity::find($id);
        return view('backend.service.activity.show',['act'=>$act]);
    }


}
