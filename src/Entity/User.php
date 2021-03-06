<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(
     * min = 3,
     * max = 50,
     * minMessage = "3 caracètres minimums",
     * maxMessage = "50 caractères maximums"
     * )
     * @Assert\NotBlank
     */
    private $username;
    /**
     * @var string $email
     * @ORM\Column(type="string", length=255)
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(
     * message = "The email '{{ value }}' is not a valid email.",
     * checkMX = true
     * )
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    /**
     * @ORM\Column(type="array")
     * @Assert\NotBlank
     */
    private $roles = [];
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="owner")
     */
    private $events;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participation", mappedBy="user", orphanRemoval=true)
     */
    private $participations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user")
     */
    private $comments;
    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->roles = ["ROLE_USER"];

    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
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
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getRoles(): ?array
    {
        return $this->roles;
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
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
            $event->setOwner($this);
        }
        return $this;
    }
    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getOwner() === $this) {
                $event->setOwner(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }
    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setUser($this);
        }
        return $this;
    }
    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getUser() === $this) {
                $participation->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function getSalt(): ? string
    {
        return null;
    }
}