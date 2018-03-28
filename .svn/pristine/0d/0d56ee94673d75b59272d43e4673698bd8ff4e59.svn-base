<?php
class ManageSelectWidget extends CWidget {
    public function init()
    {
        $departmentData = Department::model()->findAll("status=1");
        $manageData = Manage::model()->findAll("status=1");

        $this->render("manage_select",array("manageData"=>$manageData,"departmentData"=>$departmentData));
    }

    public function run()
    {

    }
}