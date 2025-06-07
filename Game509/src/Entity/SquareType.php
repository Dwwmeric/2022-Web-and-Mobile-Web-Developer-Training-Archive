<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SquareType
 *
 * @ORM\Table(name="square_type")
 * @ORM\Entity
 */
class SquareType
{
    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=250, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="header_color_text", type="string", length=6, nullable=false)
     */
    private $headerColorText;

    /**
     * @var string
     *
     * @ORM\Column(name="header_color_bg", type="string", length=6, nullable=false)
     */
    private $headerColorBg;

    /**
     * @var bool
     *
     * @ORM\Column(name="header_display", type="boolean", nullable=false)
     */
    private $headerDisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="body_color_text", type="string", length=6, nullable=false)
     */
    private $bodyColorText;

    /**
     * @var string
     *
     * @ORM\Column(name="body_color_bg", type="string", length=6, nullable=false)
     */
    private $bodyColorBg;

    /**
     * @var string
     *
     * @ORM\Column(name="body_img", type="string", length=255, nullable=false)
     */
    private $bodyImg;

    /**
     * @var string
     *
     * @ORM\Column(name="body_text", type="string", length=50, nullable=false)
     */
    private $bodyText;

    /**
     * @var string
     *
     * @ORM\Column(name="body_mode", type="string", length=0, nullable=false)
     */
    private $bodyMode;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_color_text", type="string", length=6, nullable=false)
     */
    private $footerColorText;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_color_bg", type="string", length=6, nullable=false)
     */
    private $footerColorBg;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_value", type="string", length=10, nullable=false)
     */
    private $footerValue;

    /**
     * @var bool
     *
     * @ORM\Column(name="footer_display", type="boolean", nullable=false)
     */
    private $footerDisplay;

    public function getKey(): ?string
    {
        return $this->key;
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

}