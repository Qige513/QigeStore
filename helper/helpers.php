<?php

/**
 * 对象转数组
 */
if ( !function_exists('objToArray')) {
    function objToArray($o)
    {
        // return json_decode(  json_encode($o),1 );
        return json_decode(json_encode($o), true);
    }
}

/**
 * 调试打印
 */
if ( !function_exists('debug1')) {
    function debug1($v, $bool = false)
    {
        if($v instanceof Closure){
            echo '是Closure';die;
        }

        if (is_string($v) || is_int($v)) {
            if (trim($v) == '') {
                var_dump($v);
                die;
            }
            echo $v;
        }
        elseif (is_bool($v) || is_resource($v) || is_null($v)) {
            var_dump($v);
        }
        elseif (is_array($v)) {
            echo "<pre>";
            print_r($v);
            echo "</pre>";
        }
        elseif (is_object($v)) {
            if ( !$bool) {
                var_dump($v);
            }
            else {
                $arr = objToArray($v);
                echo "<pre>";
                print_r($arr);
                echo "</pre>";
            }
        }
        else {
            var_dump($v);
        }
        die;
    }
}

/**
 * 获取ip地址
 */
if ( !function_exists('getIP')) {
    function getIP()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        }
        elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        }
        elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }

        preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
        $onlineip = $onlineipmatches[0] ? $onlineipmatches[0] : null;
        unset($onlineipmatches);
        return $onlineip;
    }
}

/**
 * xml转数组
 */
if ( !function_exists('xmlToArray')) {
    function xmlToArray($xml) {
        $array_data = json_decode(json_encode(
            simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }
}

/**
 * 生成唯一字符串
 * @return string
 */
if ( !function_exists('getUniName')) {
    function getUniName(){
        return md5(uniqid(microtime(true),true).time());
    }
}


/**
 * 得到文件的扩展名
 * @param string $filename
 * @return string
 */
if ( !function_exists('getExt')) {
    function getExt($filename){
        return strtolower(end(explode(".",$filename)));
    }
}
