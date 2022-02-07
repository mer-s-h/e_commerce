<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_product;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_product;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reduction_product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity_product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category_product;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_product;

    // /**
    //  * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="id_article")
    //  * @ORM\JoinColumn(nullable=true)
    //  */
    // private $orders;
    
    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="product")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Opinion::class, mappedBy="product")
     */
    private $opinions;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price_10ml;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price_30ml;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price_50ml;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price_100ml;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price_200ml;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->opinions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->name_product;
    }

    public function setNameProduct(string $name_product): self
    {
        $this->name_product = $name_product;

        return $this;
    }

    public function getDescriptionProduct(): ?string
    {
        return $this->description_product;
    }

    public function setDescriptionProduct(?string $description_product): self
    {
        $this->description_product = $description_product;

        return $this;
    }

    public function getReductionProduct(): ?int
    {
        return $this->reduction_product;
    }

    public function setReductionProduct(int $reduction_product): self
    {
        $this->reduction_product = $reduction_product;

        return $this;
    }

    public function getQuantityProduct(): ?int
    {
        return $this->quantity_product;
    }

    public function setQuantityProduct(int $quantity_product): self
    {
        $this->quantity_product = $quantity_product;

        return $this;
    }

    public function getCategoryProduct(): ?string
    {
        return $this->category_product;
    }

    public function setCategoryProduct(string $category_product): self
    {
        $this->category_product = $category_product;

        return $this;
    }

    public function getImageProduct(): ?string
    {
        return $this->image_product;
    }

    public function setImageProduct(?string $image_product): self
    {
        $this->image_product = $image_product;

        return $this;
    }


    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setProduct($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getProduct() === $this) {
                $order->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Opinion[]
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinion $opinion): self
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions[] = $opinion;
            $opinion->setProduct($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): self
    {
        if ($this->opinions->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getProduct() === $this) {
                $opinion->setProduct(null);
            }
        }

        return $this;
    }

    public function getPrice10ml(): ?float
    {
        return $this->price_10ml;
    }

    public function setPrice10ml(?float $price_10ml): self
    {
        $this->price_10ml = $price_10ml;

        return $this;
    }

    public function getPrice30ml(): ?float
    {
        return $this->price_30ml;
    }

    public function setPrice30ml(?float $price_30ml): self
    {
        $this->price_30ml = $price_30ml;

        return $this;
    }

    public function getPrice50ml(): ?float
    {
        return $this->price_50ml;
    }

    public function setPrice50ml(?float $price_50ml): self
    {
        $this->price_50ml = $price_50ml;

        return $this;
    }

    public function getPrice100ml(): ?float
    {
        return $this->price_100ml;
    }

    public function setPrice100ml(?float $price_100ml): self
    {
        $this->price_100ml = $price_100ml;

        return $this;
    }

    public function getPrice200ml(): ?float
    {
        return $this->price_200ml;
    }

    public function setPrice200ml(?float $price_200ml): self
    {
        $this->price_200ml = $price_200ml;

        return $this;
    }

}
