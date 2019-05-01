<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    const SEX_MAN= 1;
    const SEX_WOMAN = 0;
    const SEXES = [
        self::SEX_MAN => 'Facet',
        self::SEX_WOMAN => 'Babeczka'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $city;
    
    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Texts", mappedBy="author")
     */
    private $texts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="author")
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hash;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $firstTime;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nick;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserImage", mappedBy="user", orphanRemoval=true, cascade={"persist"})
     */
    private $userImages;










    public function __construct()
    {
        $this->friends = new ArrayCollection();
        $this->texts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->no = new ArrayCollection();
        $this->userImages = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }


    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Texts[]
     */
    public function getTexts(): Collection
    {
        return $this->texts;
    }

    public function addText(Texts $text): self
    {
        if (!$this->texts->contains($text)) {
            $this->texts[] = $text;
            $text->setAuthor($this);
        }

        return $this;
    }

    public function removeText(Texts $text): self
    {
        if ($this->texts->contains($text)) {
            $this->texts->removeElement($text);
            // set the owning side to null (unless already changed)
            if ($text->getAuthor() === $this) {
                $text->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->firstTime = true;
        $this->hash = sha1(implode('-',[time(), $this->getEmail()]));
    }
    /**
     * @ORM\PreUpdate()
     */
    public  function preUpdate(){
        $this->updatedAt = new \DateTime();
    }

    public function getFirstTime(): ?bool
    {
        return $this->firstTime;
    }

    public function setFirstTime(bool $firstTime): self
    {
        $this->firstTime = $firstTime;

        return $this;
    }



    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * @return Collection|UserImage[]
     */
    public function getUserImages(): Collection
    {
        return $this->userImages;
    }

    public function addUserImage(UserImage $userImage): self
    {
        if (!$this->userImages->contains($userImage)) {
            $this->userImages[] = $userImage;
            $userImage->setUser($this);
        }

        return $this;
    }

    public function removeUserImage(UserImage $userImage): self
    {
        if ($this->userImages->contains($userImage)) {
            $this->userImages->removeElement($userImage);
            // set the owning side to null (unless already changed)
            if ($userImage->getUser() === $this) {
                $userImage->setUser(null);
            }
        }

        return $this;
    }










}
