<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/7/28
 * Time: 16:40
 * name: 文件上传
 */
class Uploadify extends CActiveRecord
{
    public $file;
    public function rules()
    {
        return array(
            array('file',
            'allowEmpty'=>true,
            'types'=>'jpg,gif,png,exe,zip,word,excel,pdf',
            'maxSize'=>1024 * 1024 * 100,//100MB
            'tooLarge'=>'最大不超过100MB，请重新上传!'),

        );
    }
}