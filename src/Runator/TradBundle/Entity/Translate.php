<?php
namespace Runator\TradBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Translate
 *
 * @ORM\Table(name="Translate")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Runator\TradBundle\Repositories\TranslateRepository")
 */
class Translate
{
  
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $token = '';  

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="language", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $language = '';

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    
    /* metodo mágico para convertir la entidad en una cadena de texto, util para realizar desplegables */
    public function __toString() 
    {
        return $this->getName();
    }

    /* constructor con ella podemos establecer datos por defecto específicos */
    public function __construct()
    {
        
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Translate
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Translate
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Translate
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

}
