<?php
/*
 * @Author: your name
 * @Date: 2020-12-13 14:57:03
 * @LastEditTime: 2021-01-12 12:33:18
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \banyan\app\mapper\BendScreenMapper.php
 */

class UserMapper extends BaseMapper
{


    //根据病床ID获取病床信息
    public function getBybc($bc_id)
    {
        $rs = $this->db->get("t_bns_bedscreen",  "*", ["bc_id" => $bc_id]);
        return $this->__rtn($rs);
    }

    //获取病区
    public function getBq($bq_id)
    {
        $rs= $this->db->get("t_inf_region",  "*", ["bq_id" => $bq_id]);
        return $this->__rtn($rs);
    }

     //获取字典
    public function getBqDic($bq_id)
    {
        $rs = $this->db->select("sys_dic", ["dic_remark","father_key"], ["root_key" => [$bq_id,"sys"]]);
        return $this->__rtn($rs);
    }    

    //获取床位屏在线情况
    public function getListBybedscreen($bq_id)
    {
        $rs = $this->db->query(
            "select *,LPAD(bc_name, 12, 0) as dsort"
            ." from t_bns_bedscreen  where bq_id='".$bq_id."'  order by dsort ASC" 
        )->fetchAll();
        return $this->__rtn($rs);
    }

     //获取床位医生护士
     public function getListBystaf($belog_dep,$flag_job)
     {
         //INSERT(zg_iphone, 1, 7, '********') AS zg_iphone
         $rs = $this->db->query(
             "select zg_id,zg_name,zg_code"
             ." from t_inf_staff  where flag_job=:flag_job AND belog_dep=:belog_dep ",
             [":belog_dep" => $belog_dep,
              ":flag_job" => $flag_job]
         )->fetchAll();
         return $this->__rtn($rs);
     }


    //获取医联体医生
    public function getListBystafBChargeDoctor($bq_id,$flag_job)
    {
        $rs = $this->db->query(
            "select zg_id,zg_name,zg_code,zg_iphone"
            ." from t_inf_staff  where flag_job=:flag_job AND INSTR(tags_index,:tags_index)>0 ",
            [":tags_index" => $bq_id,
             ":flag_job" => $flag_job]
        )->fetchAll();
           foreach($rs as $k=>$v){
               //手机号码,先去首1,再倒桩字符串,10转62,再倒转字符串
              //$rs[$k]['zg_iphone'] = strrev (_HelpInstance::getInstance()->from10to62(strrev(substr($v["zg_iphone"],1))));
              $rs[$k]['zg_iphone'] =_HelpInstance::getInstance()->f7_from10to62($v["zg_iphone"],1);
        }

        return $this->__rtn($rs);
    }  
  

    //换床
    public function changebed($old_bc_id, $bc_id)
    {
        $rtn=false;
        try {

            $sql =" UPDATE t_bns_bedscreen AS g1 JOIN t_bns_bedscreen AS g2 ON (g1.bc_id=:old_bc_id AND g2.bc_id=:bc_id)"
            ." OR (g1.bc_id=:bc_id AND g2.bc_id =:old_bc_id)"
            ." SET g1.hz_isoccupy = g2.hz_isoccupy,g2.hz_isoccupy=g1.hz_isoccupy"
            .", g1.hz_id = g2.hz_id,g2.hz_id=g1.hz_id"
            .", g1.jz_id = g2.jz_id,g2.jz_id=g1.jz_id"
            .", g1.jz_his_id = g2.jz_his_id,g2.jz_his_id=g1.jz_his_id"
            .", g1.hz_hop_no = g2.hz_hop_no,g2.hz_hop_no=g1.hz_hop_no"
            .", g1.hz_hirdate_in = g2.hz_hirdate_in,g2.hz_hirdate_in=g1.hz_hirdate_in"
            .", g1.hz_name = g2.hz_name,g2.hz_name=g1.hz_name"
            .", g1.hz_iphone = g2.hz_iphone,g2.hz_iphone=g1.hz_iphone"
            .", g1.wx_openid = g2.wx_openid,g2.wx_openid=g1.wx_openid"
            .", g1.wx_unionid = g2.wx_unionid,g2.wx_unionid=g1.wx_unionid"
            .", g1.hz_unionid_type = g2.hz_unionid_type,g2.hz_unionid_type=g1.hz_unionid_type"
            .", g1.hz_unionid = g2.hz_unionid,g2.hz_unionid=g1.hz_unionid"
            .", g1.hz_birthdate = g2.hz_birthdate,g2.hz_birthdate=g1.hz_birthdate"
            .", g1.hz_age = g2.hz_age,g2.hz_age=g1.hz_age"
            .", g1.hz_sex = g2.hz_sex,g2.hz_sex=g1.hz_sex"
            .", g1.hz_doctor_id = g2.hz_doctor_id,g2.hz_doctor_id=g1.hz_doctor_id"
            .", g1.hz_doctor_name = g2.hz_doctor_name,g2.hz_doctor_name=g1.hz_doctor_name"
            .", g1.hz_charge_doctor_id = g2.hz_charge_doctor_id,g2.hz_charge_doctor_id=g1.hz_charge_doctor_id"
            .", g1.hz_charge_doctor_name = g2.hz_charge_doctor_name,g2.hz_charge_doctor_name=g1.hz_charge_doctor_name"
            .", g1.hz_nurse_id = g2.hz_nurse_id,g2.hz_nurse_id=g1.hz_nurse_id"
            .", g1.hz_nurse_name = g2.hz_nurse_name,g2.hz_nurse_name=g1.hz_nurse_name"
            .", g1.hz_nurse_level = g2.hz_nurse_level,g2.hz_nurse_level=g1.hz_nurse_level"
            .", g1.hz_diagnosis = g2.hz_diagnosis,g2.hz_diagnosis=g1.hz_diagnosis"
            .", g1.hz_isgrave = g2.hz_isgrave,g2.hz_isgrave=g1.hz_isgrave"
            .", g1.hz_allergy = g2.hz_allergy,g2.hz_allergy=g1.hz_allergy"
            .", g1.hz_cure = g2.hz_cure,g2.hz_cure=g1.hz_cure"
            .", g1.hz_diet = g2.hz_diet,g2.hz_diet=g1.hz_diet"
            .", g1.hz_ntrust = g2.hz_ntrust,g2.hz_ntrust=g1.hz_ntrust"
            .", g1.hz_account = g2.hz_account,g2.hz_account=g1.hz_account"
            .", g1.flag_source = g2.flag_source,g2.flag_source=g1.flag_source"
            .", g1.source_id = g2.source_id,g2.source_id=g1.source_id";

            $this->db->query($sql,
                [":bc_id" => $bc_id,
                 ":old_bc_id" => $old_bc_id]
            )->fetchAll();
            
            $rtn[0] = $this->db->get("t_bns_bedscreen",  "*", ["bc_id" => $old_bc_id]);
            $rtn[1] = $this->db->get("t_bns_bedscreen",  "*", ["bc_id" => $bc_id]);

            return $this->__rtn($rtn);

        } catch (Exception $e) {
            $this->db->pdo->rollBack();
        }

        return $this->__rtn($rtn);
    }


    //更新
    public function update($bc_id, $parrary)
    {
        $rs = $this->db->update("t_bns_bedscreen", $parrary, ["bc_id" => $bc_id]);
        return $this->__rtn($rs);
    }

    //新增字典
    public function addBqDic($root_key,$father_key,$dic_remark)
    {
        $rs = $this->db->insert("sys_dic", [
            "root_key" => $root_key,
            "father_key" => $father_key,
            "dic_remark" => $dic_remark,
            "createtime" => date('Y-m-d H:i:s', time()),
            "creater" => "custom",
            "modifytime" => date('Y-m-d H:i:s', time()),
            "moditer" => "custom"
        ]);
         //插入的id
         $insert_id = $this->db->id();
         return $this->__rtn($insert_id);
    }

    //新增人员
    public function addStaff($flag_job,$belog_dep,$zg_name)
    {
        $rs = $this->db->insert("t_inf_staff", [
            "flag_job" => $flag_job,
            "belog_dep" => $belog_dep,
            "zg_name" => $zg_name,
            "zg_sex" => "未知",
            "flag_source" =>2,
            "flag_enable" =>0,
            "createtime" => date('Y-m-d H:i:s', time()),
            "creater" => "auto",
            "modifytime" => date('Y-m-d H:i:s', time()),
            "moditer" => "auto"
        ]);
        //插入的id
        $insert_id = $this->db->id();
        return $this->__rtn($insert_id);
    }

}
