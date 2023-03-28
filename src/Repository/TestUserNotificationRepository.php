<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TestUserNotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestUserNotification::class);
    }

    public function getByNotificationAndTestUser(Notification $notification, TestUser $testUser): ?TestUserNotification
    {
        return $this->createQueryBuilder('tun')
            ->andWhere('tun.testUser = :testUser')
            ->andWhere('tun.notification = :notification')
            ->setParameters([
                'testUser' => $testUser,
                'notification' => $notification,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }
}