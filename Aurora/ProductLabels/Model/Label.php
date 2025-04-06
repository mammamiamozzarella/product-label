<?php

namespace Aurora\ProductLabels\Model;

use Magento\Framework\Model\AbstractModel;
use Aurora\ProductLabels\Api\Data\LabelInterface;

class Label extends AbstractModel implements LabelInterface
{

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Label::class);
    }

    /**
     * Get the ID of the label
     *
     * @return mixed
     */
    public function getLabelId(): mixed
    {
        return $this->getData(self::LABEL_ID);
    }

    /**
     * Set the ID of the label
     *
     * @param int $id
     * @return $this
     */
    public function setLabelId(int $id): static
    {
        return $this->setData(self::LABEL_ID, $id);
    }

    /**
     * Get label text
     *
     * @return string|null
     */
    public function getLabelText(): ?string
    {
        return $this->getData(self::LABEL_TEXT);
    }

    /**
     * Set label text
     *
     * @param string $text
     * @return $this
     */
    public function setLabelText(string $text): static
    {
        return $this->setData(self::LABEL_TEXT, $text);
    }

    /**
     * Get options
     *
     * @return string|null
     */
    public function getOptions(): ?string
    {
        return $this->getData(self::OPTIONS);
    }

    /**
     * Set options
     *
     * @param string $options
     * @return $this
     */
    public function setOptions(string $options): static
    {
        return $this->setData(self::OPTIONS, $options);
    }
}
