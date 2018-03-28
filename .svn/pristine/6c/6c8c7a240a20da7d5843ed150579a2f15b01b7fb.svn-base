<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/7/28
 * Time: 16:32
 * name: 文件上传
 */
class UploadController extends OperationController
{
    public function actionUploadify()
    {
        $timestamp = $_POST['timestamp'];
        $token = $_POST['token'];
        $targetFolder = '/uploads'; // Relative to the root

        $time = time();


        $verifyToken = md5('unique_salt' . $timestamp);

        if (!empty($_FILES) && $token == $verifyToken) {
            $username = Yii::app()->user->username;
            $uid = Yii::app()->user->id;
            $folderDate=date('Ymd',time());
            //文件夹路径 uploads/operation/username/2015-7-29/filename
            $folder = "uploads/operation/{$username}/{$folderDate}/";
            $exists_dir = $this->existsDir($folder);
            if($exists_dir==200)
            {
                $file = $_FILES['Filedata'];
                $tempFile = $file['tmp_name'];
                $fileSize = $file['size'];
                //$file_oldname = iconv('utf-8','gb2312',$file['name']);
                $file_oldname = $file['name'];

                $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/".$folder;
                //$targetFile = rtrim($targetPath,'/') . '/' . $file_oldname;



                //验证文件类型
                $fileTypes = array('jpg','jpeg','gif','png','zip','exe','rar','pdf','doc','xls','rp','xlsx','pptx','docx');
                //文件信息：dirname路径、basename文件名、extension后缀
                $fileParts = pathinfo($file_oldname);
                //文件后缀
                $file_extension = $fileParts['extension'];
                //重新命名文件
                $newFileName = date("YmdHis",time()).rand(1000,9999).".".$file_extension;
                //物理路径
                $newFileNamePath = rtrim($targetPath).'/'. $newFileName;
                //URL路径
                $urlFileNamePath = Yii::app()->baseUrl."/".$folder.$newFileName;
                //exit(CJSON::encode(array("status"=>403,"message"=>$newFileNamePath)));

                if (in_array($file_extension,$fileTypes)) {
                    move_uploaded_file($tempFile,$newFileNamePath);
                    //添加到数据库
                    $fileModel = new OperationFile();
                    $fileModel->filepath = $urlFileNamePath;
                    $fileModel->name = $file_oldname;
                    $fileModel->size =$fileSize;
                    $fileModel->mid=$uid;
                    $fileModel->createtime=time();
                    $fileModel->type = $file_extension;
                    if($fileModel->save())
                    {
                        $fileid=Yii::app()->db->getLastInsertID();
                        exit(CJSON::encode(array("status"=>200,"type"=>$file_extension,"id"=>$fileid,'size'=>Helper::FormattingSize($fileSize),"name"=>$file_oldname)));
                    }else{
                        exit(CJSON::encode(array("status"=>403,"message"=>"文件保存失败，请重新上传")));
                    }

                } else {
                    exit(CJSON::encode(array("status"=>403,"message"=>"文件类型不正确")));
                }
            }else{
                exit(CJSON::encode(array("status"=>403,"message"=>"文件目录没有写入权限")));
            }

        }
        else{
            exit(CJSON::encode(array("status"=>403,"message"=>"文件不存在")));
        }
    }
    /*
     * 检查文件夹是否存在，不存在则创建
     * */
    protected function existsDir($folder)
    {
        //判断目录存在否，存在给出提示，不存在则创建目录
        if (is_dir($folder)){
            //echo "对不起！目录 " . $folder . " 已经存在！";
            return 200;
        }else{
            //第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
            $res=mkdir(iconv("UTF-8", "GBK", $folder),0777,true);
            if ($res){
                return 200;
            }else{
                return 400;
            }
        }
    }
}
