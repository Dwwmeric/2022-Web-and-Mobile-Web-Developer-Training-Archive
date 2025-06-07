<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Squares
 *
 * @ORM\Table(name="squares")
 * @ORM\Entity
 */
class Squares
{ 
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="order_square", type="integer", nullable=false)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="type_square", type="string", length=0, nullable=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="header_color_text", type="string", length=7, nullable=false, options={"default"="#00749d"})
     */
    private $headerColorText = '#00749d';

    /**
     * @var string
     *
     * @ORM\Column(name="header_color_bg", type="string", length=7, nullable=false, options={"default"="#ffffff"})
     */
    private $headerColorBg = '#ffffff';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="header_display", type="boolean", nullable=false)
     */
    private $headerDisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="body_color_text", type="string", length=7, nullable=false, options={"default"="#003b54"})
     */
    private $bodyColorText = '#003b54';

    /**
     * @var string
     *
     * @ORM\Column(name="body_color_bg", type="string", length=7, nullable=false, options={"default"="#eac474"})
     */
    private $bodyColorBg = '#eac474';

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_img", type="string", length=250, nullable=true)
     */
    private $bodyImg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_text", type="string", length=50, nullable=false)
     */
    private $bodyText;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_color_text", type="string", length=7, nullable=false, options={"default"="#00749d"})
     */
    private $footerColorText = '#00749d';

    /**
     * @var string
     *
     * @ORM\Column(name="footer_color_bg", type="string", length=7, nullable=false, options={"default"="#eac474"})
     */
    private $footerColorBg = '#eac474';

    /**
     * @var string|null
     *
     * @ORM\Column(name="footer_value", type="string", length=10, nullable=false)
     */
    private $footerValue;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="footer_display", type="boolean", nullable=false)
     */
    private $footerDisplay;

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

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(int $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHeaderColorText(): ?string
    {
        return $this->headerColorText;
    }

    public function setHeaderColorText(string $headerColorText): self
    {
        $this->headerColorText = $headerColorText;

        return $this;
    }

    public function getHeaderColorBg(): ?string
    {
        return $this->headerColorBg;
    }

    public function setHeaderColorBg(string $headerColorBg): self
    {
        $this->headerColorBg = $headerColorBg;

        return $this;
    }

    public function getHeaderDisplay(): ?bool
    {
        return $this->headerDisplay;
    }

    public function setHeaderDisplay(bool $headerDisplay): self
    {
        $this->headerDisplay = $headerDisplay;

        return $this;
    }

    public function getBodyColorText(): ?string
    {
        return $this->bodyColorText;
    }

    public function setBodyColorText(string $bodyColorText): self
    {
        $this->bodyColorText = $bodyColorText;

        return $this;
    }

    public function getBodyColorBg(): ?string
    {
        return $this->bodyColorBg;
    }

    public function setBodyColorBg(string $bodyColorBg): self
    {
        $this->bodyColorBg = $bodyColorBg;

        return $this;
    }

    public function getBodyImg(): ?string
    {
        return $this->bodyImg;
    }

    public function setBodyImg(?string $bodyImg): self
    {
        $this->bodyImg = $bodyImg;

        return $this;
    }

    public function getBodyText(): ?string
    {
        return $this->bodyText;
    }

    public function setBodyText(string $bodyText): self
    {
        $this->bodyText = $bodyText;

        return $this;
    }

    public function getFooterColorText(): ?string
    {
        return $this->footerColorText;
    }

    public function setFooterColorText(string $footerColorText): self
    {
        $this->footerColorText = $footerColorText;

        return $this;
    }

    public function getFooterColorBg(): ?string
    {
        return $this->footerColorBg;
    }

    public function setFooterColorBg(string $footerColorBg): self
    {
        $this->footerColorBg = $footerColorBg;

        return $this;
    }

    public function getFooterValue(): ?string
    {
        return $this->footerValue;
    }

    public function setFooterValue(string $footerValue): self
    {
        $this->footerValue = $footerValue;

        return $this;
    }

    public function getFooterDisplay(): ?bool
    {
        return $this->footerDisplay;
    }

    public function setFooterDisplay(bool $footerDisplay): self
    {
        $this->footerDisplay = $footerDisplay;

        return $this;
    }


}
