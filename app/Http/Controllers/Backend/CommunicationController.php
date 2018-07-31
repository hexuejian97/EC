<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communicate\Ask;
use App\Models\Communicate\Carousel;
use App\Models\Communicate\Order;
use App\Models\Communicate\Question;
use App\Models\Communicate\Hotspot;
use App\Models\Service\Physician;
use App\Models\Service\Store;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class DashboardController.
 */
class CommunicationController extends Controller
{


    public function carouselIndex(){
        return view('backend.communicate.carousel.index');
    }

    public function carouselData(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = Carousel::select('id','car_title','car_picture','car_link');
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function carouselAdd(){
        return view('backend.communicate.carousel.create');
    }

    public function carouselCreate(Request $request){
        try{
            $req = $request->all();
            $car = new Carousel();
            $car->car_title = $req['car_title'];
            $car->car_link = $req['car_link'];
            $car->car_picture = $req['car_picture'];
            if($car->save()){
                return redirect()->route('admin.carousel.index')->withFlashSuccess('创建成功');
            }else{
                return back()->withErrors('创建失败 ,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function carouselUpdate($id){
        $car = Carousel::find($id);
        return view('backend.communicate.carousel.edit',['car'=>$car]);
    }

    public function carouselEdit(Request $request){
        try{
            $req = $request->all();
            //echo var_dump($req);
            $car = Carousel::find($req['id']);
            $car->car_title = $req['title'];
            $car->car_link = $req['link'];
            $car->car_picture = $req['picture'];
            if($car->save()){
                return redirect()->route('admin.carousel.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function carouselDelete(Request $request){
        try{
            $id = $request->input('id');
            $car = Carousel::find($id);
            if($car->delete()){
                return redirect()->route('admin.carousel.index')->withFlashSuccess('删除成功');
            }else{
                return back()->withErrors('删除失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function hotspotIndex(){
        return view('backend.communicate.hotspot.index');
    }

    public function hotspotData(Request $request){
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $query = Hotspot::select('id','hot_title','hot_picture','hot_link');
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function hotspotAdd(){
        return view('backend.communicate.hotspot.create');
    }

    public function hotspotCreate(Request $request){
        try{
            $req = $request->all();
            $hot = new Hotspot();
            $hot->hot_title = $req['hot_title'];
            $hot->hot_link = $req['hot_link'];
            $hot->hot_picture = $req['hot_picture'];

            if($hot->save()){
                return redirect()->route('admin.hotspot.index')->withFlashSuccess('创建成功');
            }else{
                return back()->withErrors('创建失败 ,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function hotspotUpdate($id){
        $hot = Hotspot::find($id);
        return view('backend.communicate.hotspot.edit',['hot'=>$hot]);
    }

    public function hotspotEdit(Request $request){
        try{
            $req = $request->all();
            $hot = Hotspot::find($req['id']);
            $hot->hot_title = $req['title'];
            $hot->hot_link = $req['link'];
            $hot->hot_picture = $req['picture'];
            if($hot->save()){
                return redirect()->route('admin.hotspot.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function hotspotDelete(Request $request){
        try{
            $id = $request->input('id');
            $hot = Hostpot::find($id);
            if($hot->delete()){
                return redirect()->route('admin.hostpot.index')->withFlashSuccess('删除成功');
            }else{
                return back()->withErrors('删除失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }








}
