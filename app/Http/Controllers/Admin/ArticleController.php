<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Article;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /*
     *
     * 数据导入
     */
    public function ImportDatas(Request $request)
    {
        return view('admin.import');
    }

    /*
     * 数据导入处理
     *
     */
    public function PostImportDatas(Request $request)
    {
        $request['content']=array_unique(explode(PHP_EOL,$request->input('content')));
        $request['user_id']=Auth::id();
        if(count($request['content'])>0)
        {
        foreach ($request['content'] as $content)
        {
            if(!empty($content))
            {
                Article::create(['content'=>$content,'user_id'=>$request['user_id'],'type'=>$request['type']]);
            }
        }
            return  redirect(route('home'));
        }

    }
    /*
     * 数据语句查看
     */
    public function ViewArticleDatas(Request $request,$option='')
    {
        if(empty($option))
        {
            $articledatas=Article::where('id','<>',0)->orderBy('id','desc')->paginate(50);
        }else{
            $articledatas=Article::where('type',$option)->orderBy('id','desc')->paginate(50);
        }

        return view('admin.articledata',compact('articledatas'));
    }

    /*
     * 文章生成
     */
    public function ArticleCreate()
    {
        if(!User::where('id',Auth::id())->value('is_create'))
        {
            return '无权限操作！';
        }
        return view('admin.articlecreate');
    }
    /*
     * 文章生成处理
     */
    public function PostArticleCreate(Request $request)
    {
        $options=$request->all();
        foreach ($options as $key=>$value)
        {
            if($key!='_token' && $key!=='brandname')
            {
                $articledatas[$key]=Article::where('type',$key)->inRandomOrder()->take(rand(6,10))->get();
            }
        }
        $jmlcdatas=Article::where('type','jmlc')->inRandomOrder()->first();
        //dd($jmlcdatas->content);
        return view('admin.articlecreated',compact('jmlcdatas','options','articledatas'));
    }
    /*
     * 语句查看
     */
    public function Previewdatas($id)
    {
        $thisarticle=Article::where('id',$id)->findOrFail($id);
        return view('admin.preview',compact('thisarticle'));
    }

    /*
     * 语句编辑
     */
    public function EditArticledatas($id)
    {
        $thisarticle=Article::where('id',$id)->findOrFail($id);
        return view('admin.editarticle',compact('thisarticle'));
    }

    /*
     * 编辑内容处理
     */
    public function PostEditArticledatas(Request $request,$id)
    {
        Article::where('id',$id)->update(['content'=>$request['content'],'type'=>$request['type']]);
        return '修改成功';
    }
    /*
     * 内容删除
     */
    public function DeleteContentdatas($id)
    {
        Article::where('id',$id)->delete();
        return redirect()->back();
    }
}
