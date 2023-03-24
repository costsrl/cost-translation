<?php
/**
 * Message.php
 *
 * Stores translations
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   LaminasI18nDoctrineLoader
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace CostTranslation\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Form\Annotation;

/**
 * @ORM\Table (name="languagedb")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int Auto-Incremented Primary Key
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $messageId;


    /**
     * @var string Translation key name
     *
     * @ORM\Column(type="string", name="translationKey")
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Key"})
     * @Annotation\Required(true)
     */
    protected $key;

    /**
     * @var string The translated message
     *
     * @ORM\Column(type="string", name="textEn")
     * @Annotation\Type("Laminas\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Attributes({"style":"width:450px"})
     * @Annotation\Options({"label":"TextEn"})
     * @Annotation\Required(true)
     */
    protected $textEn;

    /**
     * @var string The translated message
     *
     * @ORM\Column(type="string", name="textIt")
     * @Annotation\Type("Laminas\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Attributes({"style":"width:450px"})
     * @Annotation\Options({"label":"TextIt"})
     * @Annotation\Required(true)
     */
    protected $textIt;

    /**
     * @var string The translated message
     *
     * @ORM\Column(type="string", name="textDe")
     * @Annotation\Type("Laminas\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Attributes({"style":"width:450px"})
     * @Annotation\Options({"label":"TextDE"})
     * @Annotation\Required(true)
     */
    protected $textDe;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getTextEn()
    {
        return $this->textEn;
    }

    /**
     * @param string $textEn
     */
    public function setTextEn($textEn)
    {
        $this->textEn = $textEn;
    }


    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     * @return string
     */
    public function getTextIt()
    {
        return $this->textIt;
    }

    /**
     * @param string $textIt
     */
    public function setTextIt($textIt)
    {
        $this->textIt = $textIt;
    }

    /**
     * @return string
     */
    public function getTextDe()
    {
        return $this->textDe;
    }

    /**
     * @param string $textDe
     */
    public function setTextDe($textDe)
    {
        $this->textDe = $textDe;
    }


}