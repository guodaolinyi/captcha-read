<?php
/**
 * Created by PhpStorm.
 * User: kurisu
 * Date: 2018/01/13
 * Time: 1:21
 */

namespace CAPTCHAReader\src\Repository\Pretreatment;


class PretreatmentYKTRepository
{
    /**
     * @param $width
     * @param $height
     * @param $image
     * @return array
     * 二值化
     */
    public function binarization( $width , $height , $image ){
        $imageArr = [];
        for($y = 0; $y < $height; ++$y){
            for($x = 0; $x < $width; ++$x){
                $rgb      = imagecolorat( $image , $x , $y );
                $rgbArray = imagecolorsforindex( $image , $rgb );
                if ($rgbArray['red'] == 255 && $rgbArray['green'] == 255 && $rgbArray['blue'] == 255) {
                    $imageArr[$y][$x] = '0';
                } else{
                    $imageArr[$y][$x] = '1';
                }
            }
        }
        return $imageArr;
    }

    /**
     * @param $width
     * @param $height
     * @param $array
     * @return mixed
     * 简单的降噪方法
     */
    public function SimpleNoiseCancel( $width , $height , $array )
    {
        for($y = 0; $y < $height; ++$y)
        {
            for($x = 0; $x < $width; ++$x)
            {
                if ($array[$y][$x] == 1)
                {
                    $num = 0;
                    // 上
                    if (isset( $array[$y - 1][$x] ))
                    {
                        $num = $num + $array[$y - 1][$x];
                    }
                    // 下
                    if (isset( $array[$y + 1][$x] ))
                    {
                        $num = $num + $array[$y + 1][$x];
                    }
                    // 左
                    if (isset( $array[$y][$x - 1] ))
                    {
                        $num = $num + $array[$y][$x - 1];
                    }
                    // 右
                    if (isset( $array[$y][$x + 1] ))
                    {
                        $num = $num + $array[$y][$x + 1];
                    }
                    // 上左
                    if (isset( $array[$y - 1][$x - 1] ))
                    {
                        $num = $num + $array[$y - 1][$x - 1];
                    }
                    // 上右
                    if (isset( $array[$y - 1][$x + 1] ))
                    {
                        $num = $num + $array[$y - 1][$x + 1];
                    }
                    // 下左
                    if (isset( $array[$y + 1][$x - 1] ))
                    {
                        $num = $num + $array[$y + 1][$x - 1];
                    }
                    // 下右
                    if (isset( $array[$y + 1][$x + 1] ))
                    {
                        $num = $num + $array[$y + 1][$x + 1];
                    }
                    if ($num < 3)
                    {//如果周围的像素数量小于3（也就是为1，或2）则判定为噪点，去除
                        $array[$y][$x] = '0';
                    }
                    else
                    {
                        $array[$y][$x] = '1';
                    }
                }
            }
        }
        return $array;

    }
    /**
     * @param $width
     * @param $height
     * @param $array
     * @return mixed
     * 简单的降噪方法
     */
    public function noiseCancel($width, $height, $array)
    {
        for ($y = 0; $y < $height; ++$y) {
            for ($x = 0; $x < $width; ++$x) {
                //计算5*5的领点
                /** y x
                 * -2-2 -2-1 -2-0 -2+1 -2+2
                 * -1-2 -1-1 -1-0 -1+1 -1+2
                 * -0-2 -0-1 -0-0 -0+1 -0+2
                 * +1-2 +1-1 +1-0 +1+1 +1+2
                 * +2-2 +2-1 +2-0 +2+1 +2+2
                 */
                $num = 0;
                $num += $array[$y - 2][$x - 2] ?? 0;
                $num += $array[$y - 2][$x - 1] ?? 0;
                $num += $array[$y - 2][$x] ?? 0;
                $num += $array[$y - 2][$x + 1] ?? 0;
                $num += $array[$y - 2][$x + 2] ?? 0;

                $num += $array[$y - 1][$x - 2] ?? 0;
                $num += $array[$y - 1][$x - 1] ?? 0;
                $num += $array[$y - 1][$x] ?? 0;
                $num += $array[$y - 1][$x + 1] ?? 0;
                $num += $array[$y - 1][$x + 2] ?? 0;

                $num += $array[$y][$x - 2] ?? 0;
                $num += $array[$y][$x - 1] ?? 0;
                $num += $array[$y][$x] ?? 0;
                $num += $array[$y][$x + 1] ?? 0;
                $num += $array[$y][$x + 2] ?? 0;

                $num += $array[$y + 1][$x - 2] ?? 0;
                $num += $array[$y + 1][$x - 1] ?? 0;
                $num += $array[$y + 1][$x] ?? 0;
                $num += $array[$y + 1][$x + 1] ?? 0;
                $num += $array[$y + 1][$x + 2] ?? 0;

                $num += $array[$y + 2][$x - 2] ?? 0;
                $num += $array[$y + 2][$x - 1] ?? 0;
                $num += $array[$y + 2][$x] ?? 0;
                $num += $array[$y + 2][$x + 1] ?? 0;
                $num += $array[$y + 2][$x + 2] ?? 0;

                if ($array[$y][$x]) {
                    //如果周围的像素数量小于3（也就是为1，或2）则判定为噪点，去除
                    if ($num < 5) {
                        $array[$y][$x] = '0';
                    } else {
                        $array[$y][$x] = '1';
                    }
                }
            }
        }
        return $array;
    }

    /**
     * @param $arr
     * @param $width
     * @param $height
     * @return array
     */
    public function erosion($arr, $width, $height)
    {
        $result = [];
        foreach ($arr as $indexY => $row) {
            foreach ($row as $indexX => $rowX) {
                $top = $indexY != 0;
                $leftmost = $indexX != 0;
                $rightmost = $indexX != $width - 1;
                $bottom = $indexY != $height - 1;

                $sum = 0;
                $sum += $arr[$indexY][$indexX];
                if ($top) {
                    //正上
                    $sum += $arr[$indexY - 1][$indexX];
                }
                if ($leftmost) {
                    //左上
//                    $sum += $top ? $arr[$indexY - 1][$indexX - 1] : 0;
                    //左
                    $sum += $arr[$indexY][$indexX - 1];
                    //左下
                    $sum += $bottom ? $arr[$indexY + 1][$indexX - 1] : 0;
                }
                if ($bottom) {
                    //正下
                    $sum += $arr[$indexY + 1][$indexX];
                }
                if ($rightmost) {
                    //右上
                    $sum += $top ? $arr[$indexY - 1][$indexX + 1] : 0;
                    //右
                    $sum += $arr[$indexY][$indexX + 1];
                    //右下
//                    $sum += $bottom ? $arr[$indexY + 1][$indexX + 1] : 0;
                }

                if ($sum < 5) {
                    $result[$indexY][$indexX] = 0;
                } else {
                    $result[$indexY][$indexX] = 1;
                }

            }
        }
        return $result;
    }
}