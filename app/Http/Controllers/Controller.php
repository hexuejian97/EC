<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function gettree($arr,$pid,$step=0){
        global $tree;
        foreach($arr as $key=>$val) {
            if($val['prent_id'] == $pid) {
                $flg = str_repeat('&nbsp;&nbsp;&nbsp;'.'└―-',$step);
                $val['name'] = $flg.$val['name'];
                $tree[] = $val;
                $this->GetTree($arr , $val['id'] ,$step+1);
            }
        }
        return $tree;
    }
}
