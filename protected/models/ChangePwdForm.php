<?php
/**
 * Created by AWangBa.com
 * User: hanyoujun@gmail.com
 * Date: 13-3-28 下午2:24
 * Explain:修改密码模块
 */
class ChangePwdForm extends CFormModel
{
    public $old, $password, $again;
    private $_identity;

    public function rules()
    {
        return array(
            array('old,password,again', 'required'), //用户名、密码、确认密码必须填写
            array('old,password,again', 'length', 'min' => 6, 'max' => 16), //密码长度为6-16
            array('again', 'compare', 'compareAttribute' => 'password'), //密码与确认密码必须一致
            array('old', 'authenticate'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'old' => '原始密码',
            'password' => '修改密码',
            'again' => '确认密码',
        );
    }

    /**
     * 验证规则
     */
    public function authenticate($attribute, $params)
    {

        if (!$this->hasErrors()) {
            $model = $this->loadModel();
            if (!$model->validatePassword($this->old)) {
                $this->addError('old', '原始密码错误');
            }
        }
    }

    /**
     * 修改
     */
    public function change()
    {
        if (!$this->hasErrors()) {
            $model = $this->loadModel();
            $model->password = $model->createPassword($this->password);
            $model->update();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return MemberInfo|null
     */
    private function loadModel()
    {
        return MemberInfo::model()->getById(Yii::app()->user->getState('member_uid'));
    }


}