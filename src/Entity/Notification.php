<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $message;

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $deliveryTypes = [];

    #[ORM\OneToMany(mappedBy: 'notification', targetEntity: TestUser::class)]
    private Collection $users;

    public function __construct(string $message)
    {
        $this->message = $message;
        $this->createdAt = new DateTime();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getDeliveryTypes(): array
    {
        return $this->deliveryTypes;
    }

    public function addDeliveryType(string $type): self
    {
        $this->deliveryTypes[] = $type;

        return $this;
    }

    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    public function addUser(TestUser $user): self
    {
        $this->users->add($user);

        return $this;
    }
}