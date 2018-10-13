<?php
/**
 * Created by PhpStorm.
 * User: kurisu
 * Date: 2018/01/08
 * Time: 2:36
 */

return [

    /*
    |--------------------------------------------------------------------------
    | studyGroup
    |--------------------------------------------------------------------------
    |
    | 需要学习的组和使用的各个组件
    |
    */

    'studyGroup' => [
        'zhengfang' => [
            [
                \CAPTCHAReader\src\App\GetImageInfo\GetImageInfo::class,
                \CAPTCHAReader\src\App\Pretreatment\PretreatmentZhengFang::class,
                \CAPTCHAReader\src\App\Cutting\CuttingZhengFangFixed::class,
                \CAPTCHAReader\src\App\Identify\IdentifyZhengFangColLevenshtein::class,
            ],
        ],
        'YKT' => [
            [
                \CAPTCHAReader\src\App\GetImageInfo\GetImageInfo::class,
                \CAPTCHAReader\src\App\Pretreatment\PretreatmentYKT::class,
                \CAPTCHAReader\src\App\Cutting\CuttingYKTFixed::class,
                \CAPTCHAReader\src\App\Identify\IdentifyYKTColLevenshtein::class,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | studySampleGroup
    |--------------------------------------------------------------------------
    |
    | 学习 样本组
    |
    */

    'studySampleGroup' => [
        'neea.edu.cnA' => __DIR__ . '/../../sample/StudySamples/neea.edu.cn/a/',
        'neea.edu.cnB' => __DIR__ . '/../../sample/StudySamples/neea.edu.cn/b/',
        'neea.edu.cnC' => __DIR__ . '/../../sample/StudySamples/neea.edu.cn/c/',
        'neea.edu.cn' => __DIR__ . '/../../sample/StudySamples/neea.edu.cn/',
        'qinguo'      => __DIR__ . '/../../sample/StudySamples/QinGuo/',
        'tianyi'      => __DIR__ . '/../../sample/StudySamples/TianYi/',
        'zhengfang'   => __DIR__ . '/../../sample/StudySamples/ZhengFang/',
        'YKT'   => __DIR__ . '/../../sample/StudySamples/YKT/',
    ],

    /*
    |--------------------------------------------------------------------------
    | testSampleGroup
    |--------------------------------------------------------------------------
    |
    | 测试 样本组
    |
    */
    'testSampleGroup'  => [
        'neea.edu.cn' => __DIR__ . '/../../sample/TestSamples/neea.edu.cn/',
        'neea.edu.cnA' => __DIR__ . '/../../sample/TestSamples/neea.edu.cn/',
        'neea.edu.cnB' => __DIR__ . '/../../sample/TestSamples/neea.edu.cn/',
        'neea.edu.cnC' => __DIR__ . '/../../sample/TestSamples/neea.edu.cn/',
        'qinguo'      => __DIR__ . '/../../sample/TestSamples/QinGuo/',
        'tianyi'      => __DIR__ . '/../../sample/TestSamples/TianYi/',
        'zhengfang'   => __DIR__ . '/../../sample/TestSamples/ZhengFang/',
        'YKT'   => __DIR__ . '/../../sample/TestSamples/YKT/',
    ],

    /*
    |--------------------------------------------------------------------------
    | LogPath
    |--------------------------------------------------------------------------
    | 日志位置
    */

    'LogPath' => __DIR__.'/../Log/' ,

    /*
    |--------------------------------------------------------------------------
    | dictionary Sample Limit by automaticStudy
    |--------------------------------------------------------------------------
    | 自动训练的字典数量上限
    */

    'dictionarySampleLimit' => 4000 ,

    /*
    |--------------------------------------------------------------------------
    | test Success Rate Line by automaticStudy
    |--------------------------------------------------------------------------
    | 自动训练到达触发的测试成功率线
    */

    'testSuccessRateLine' => 95 ,

];