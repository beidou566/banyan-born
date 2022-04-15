<?php
/*
 * @Author: your name
 * @Date: 2020-12-13 14:57:03
 * @LastEditTime: 2021-01-12 12:19:21
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \banyan\app\mapper\Mapper.php
 */

abstract class BaseMapper
{
    protected $db;
    protected $logger;

    public function __construct($app)
    {
        $this->db = $app->db;
        $this->logger = $app->logger;
    }

    public function __rtn($rs)
    {
        if ($this->db->error()[0] !== "00000") {
            $this->logger->addError(implode(",", $this->db->error()) . $this->db->last());
            throw new \Exception('system exception', 70001);
        }
        return $rs;
    }

}
