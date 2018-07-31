<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/5/16
 * Time: 14:41
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Service\Video;
use Illuminate\Http\Request;
use Mockery\Exception;
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
        $query = Video::select('id','title','intro','picture','ll');
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
            $video = new Video();
            $video->title = $request->input('title');
            $video->intro = $request->input('intro');
            $video->picture=$request->input('picture');
            $video->created_at = date('Y-m-d H:i:s');
            $video->updated_at = date('Y-m-d H:i:s');
            if($video->save()){
                return redirect()->route('admin.video.index')->withFlashSuccess('添加成功');
            }else{
                return back()->withErrors('添加视频呢失败，请重新添加');
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
        $video = Video::find($id);
        return view('backend.service.video.show',['video'=>$video]);
    }

    /**
     * 修改数据
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id){
        $video = Video::find($id);
        return view('backend.service.video.edit',['video'=>$video]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return $this
     */

public function edit(Request $request){

         $video= Video::find($request->input('id'));
           // echo dump($video);
        $video->title = $request->input('title');
        $video->intro =$request->input('intro');
        $video->picture =$request->input('picture');

           if($video->save()){
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
        $video = new Video();
        $videoinfo = $video->find($request->input('id'));
        if($videoinfo->delete()){
            return return_json();
        }else{
            return return_err_json('请稍后再试','2001');
        }
    }

}
