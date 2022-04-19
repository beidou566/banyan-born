<?php
namespace Banyan\Mapper;

use Psr\Container\ContainerInterface;

abstract class Mapper
{
    protected $db;
    protected $logger;

    public function __construct(ContainerInterface $c)
    {
        $this->logger=$c->get('logger');
        $this->db=$c->get('db');
    }
}
