<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passaword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="user", orphanRemoval=true)
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserHasEvent", mappedBy="user", orphanRemoval=true)
     */
    private $userHasEvents;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->userHasEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassaword(): ?string
    {
        return $this->passaword;
    }

    public function setPassaword(string $passaword): self
    {
        $this->passaword = $passaword;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserHasEvent[]
     */
    public function getUserHasEvents(): Collection
    {
        return $this->userHasEvents;
    }

    public function addUserHasEvent(UserHasEvent $userHasEvent): self
    {
        if (!$this->userHasEvents->contains($userHasEvent)) {
            $this->userHasEvents[] = $userHasEvent;
            $userHasEvent->setUser($this);
        }

        return $this;
    }

    public function removeUserHasEvent(UserHasEvent $userHasEvent): self
    {
        if ($this->userHasEvents->contains($userHasEvent)) {
            $this->userHasEvents->removeElement($userHasEvent);
            // set the owning side to null (unless already changed)
            if ($userHasEvent->getUser() === $this) {
                $userHasEvent->setUser(null);
            }
        }

        return $this;
    }
}
