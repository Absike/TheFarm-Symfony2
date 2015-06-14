<?php

namespace Api\RestBundle\Lib;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * Custom builder Query
 *
 * @package RepositoryQuery
 * @version 0.1
 * @copyright Copyright 2015 (C) Hassan Absike. - All Rights Reserved
 */
class RepositoryQuery
{
    protected $em;
    protected $logger;

    /**
     * @param EntityManager $em
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Custom building doctrine query
     * @param $entity
     * @param array $filter
     * @param array $params
     * @return array result
     */
    public function _query($entity, $filter = array(), $params = array())
    {
        $qb = $this->getRepository($entity)->createQueryBuilder('q');

        if (count($filter)) {
            foreach ($filter as $key => $value) {
                $qb->andWhere('q.' . $key . '=' . ':' . $key);
                $qb->setParameter($key, $value);
            }
        }

        if (isset($params['orderby'])) $qb->orderBy($params['orderby']);
        if (isset($params['limit'])) $qb->setMaxResults($params['limit']);

        //Logger query
        $this->logger->info(sprintf('Query executed ' . $qb->getQuery()->getSQL()));

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $entity
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($entity)
    {
        return $this->em->getRepository($entity);
    }
}

