<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/12/25
 * Time: 16:04
 */

namespace Common\Util\Alipay;


class AlipayCore
{
 /**
 * 除去数组中的空值和签名参数
 * @param $para 签名参数组
 * return 去掉空值与签名参数后的新签名参数组
 */
  public static function paraFilter($para) {
     $para_filter = array();
     while (list ($key, $val) = each ($para)) {
          if($key == "sign" || $key == "sign_type" || $val == "")continue;
          else	$para_filter[$key] = $para[$key];
     }
     return $para_filter;
    }
     /**
      * 对数组排序
      * @param $para 排序前的数组
      * return 排序后的数组
      */
     function argSort($para) {
          ksort($para);
          reset($para);
          return $para;
     }
     /**
      * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
      * @param $para 需要拼接的数组
      * return 拼接完成以后的字符串
      */
     function createLinkstring($para) {
          $arg  = "";
          while (list ($key, $val) = each ($para)) {
               $arg.=$key."=".$val."&";
          }
          //去掉最后一个&字符
          $arg = substr($arg,0,count($arg)-2);

          //如果存在转义字符，那么去掉转义
          if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

          return $arg;
     }
     /**
      * 签名字符串
      * @param $prestr 需要签名的字符串
      * @param $key 私钥
      * return 签名结果
      */
     function md5Sign($prestr, $key) {
          $prestr = $prestr . $key;
          return md5($prestr);
     }
     /**
      * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
      * @param $para 需要拼接的数组
      * return 拼接完成以后的字符串
      */
     function createLinkstringUrlencode($para) {
          $arg  = "";
          while (list ($key, $val) = each ($para)) {
               $arg.=$key."=".urlencode($val)."&";
          }
          //去掉最后一个&字符
          $arg = substr($arg,0,count($arg)-2);

          //如果存在转义字符，那么去掉转义
          if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

          return $arg;
     }
}