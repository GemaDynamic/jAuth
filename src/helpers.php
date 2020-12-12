<?php
// 定义全局工具方法

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

if (!function_exists("getPrepage")) {
    /**
     * 获取分页
     */
    function getPrepage()
    {
        $request = request();
        $key = config("app.paginate.per_page_key", "per_page");
        $value = config("app.paginate.per_page", 15);
        return (int) ((isset($request[$key]) && $request->$key > 0 && $request->$key <= 100) ? $request->$key : $value);
    }
}

if (!function_exists("success")) {
    //返回成功 HTTP状态码是200  内容在data中
    function success($data = null, $status = Response::HTTP_OK, array $headers = [], int $options = JSON_UNESCAPED_UNICODE)
    {
        $res = null;
        if (config("app.api.restful", true)) {
            $data && $res = $data;
            $status == Response::HTTP_OK && $status = $res ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
        } else {
            $res["code"] = 200;
            $res["message"] = "OK";
            $data && $res["data"] = $data;
        }
        $response = response()->json($res, $status, $headers, $options);

        return  $response;
    }
}
if (!function_exists("error")) {
    /***
     * 返回错误
     * @param $code
     * @param string $message
     * @param array $detail
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    function error($message = "fail", $code = "ERROR", $status = Response::HTTP_BAD_REQUEST, $data = null, array $headers = [], int $options = JSON_UNESCAPED_UNICODE)
    {
        $res = [
            "code" => $code,
            "message" => __($message)
        ];
        $data && $res["data"] = $data;

        !config("app.api.restful", true) && $status = Response::HTTP_OK;

        $response = response()->json($res, $status, $headers, $options);

        return $response;
    }
}

// if (!function_exists("logRequest")) {
//     //返回成功 HTTP状态码是200  内容在data中
//     function logRequest($code)
//     {
//         //记录本次操作
//         $request = request();
//         $user_id = auth()->id();
//         $ip = $request->ip();
//         $url = $request->url();
//         $req_data = json_encode($request->all(), 256);
//         $status_code = $code;
//     }
// }
if (!function_exists("getCache")) {
    /**
     * 从缓存中查找数据
     * 未找到且传了 $closure 则返回 $closure的返回值
     */
    function getCache($key, $closure = null, $tags = null, $ttl = -1)
    {
        //通过key和tags 查询缓存
        if ($tags !== null) {
            is_string($tags) &&  $tags = [$tags];
            if (is_array($tags)) {
                $res = Cache::tags($tags)->get($key, null);
            } else {
                throw new Exception("缓存tags 必须是 string或者array", 500);
            }
        } else {
            $res = Cache::get($key, null);
        }
        // 未找到
        if ($res === null && $closure && is_callable($closure)) {
            //生成要缓存的结果
            $res = $closure($key);
            //通过key和tags 缓存结果
            if ($tags !== null) {
                Cache::tags(array_unique($tags))->put($key, $res, $ttl === -1 ? config("cache.ttl") : $ttl);
            } else {
                Cache::put($key, $res, $ttl === -1 ? config("cache.ttl") : $ttl);
            }
        }
        return $res;
    }
}
if (!function_exists('query')) {
    /**
     * 根据condition 查询builder
     *
     * @param mixd $builder     查询构造器
     * @param array $condition  查询条件
     *
     * @return Builder
     */
    function query(&$builder, $condition = [])
    {
        foreach ($condition as $key => $value) {
            if (is_array($value)) {
                $builder->where([$value]);
            } elseif (is_string($value)) {
                $builder->where($key, $value);
            } elseif (is_callable($value)) {
                $builder->where($value);
            }
        }
        return $builder;
    }
}

if (!function_exists('notfound')) {

    function notfound($model)
    {
        $e = new ModelNotFoundException();
        $e->setModel($model, $model->id);
        throw $e;
    }
}
