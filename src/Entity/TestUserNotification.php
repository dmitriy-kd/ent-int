<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestUserNotificationRepository::class)]
class TestUserNotification
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Notification::class)]
    private Notification $notification;

    #[ORM\ManyToOne(targetEntity: TestUser::class)]
    private TestUser $testUser;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $processedAt = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $sentBy = null;

    public function getProcessedAt(): DateTime
    {
        return $this->processedAt;
    }

    public function setProcessedAt(DateTime $processedAt = new DateTime()): self
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }

    public function setNotification(Notification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    public function getSentBy(): ?string
    {
        return $this->sentBy;
    }

    public function setSentBy(string $sentBy): self
    {
        $this->sentBy = $sentBy;

        return $this;
    }
}