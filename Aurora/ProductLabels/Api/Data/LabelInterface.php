<?php

namespace Aurora\ProductLabels\Api\Data;

interface LabelInterface
{
    public const LABEL_ID = 'label_id';
    public const LABEL_TEXT = 'label_text';
    public const OPTIONS = 'options';

    /**
     * Get label ID
     *
     * @return mixed
     */
    public function getLabelId(): mixed;

    /**
     * Set label ID
     *
     * @param int $id
     * @return $this
     */
    public function setLabelId(int $id): static;

    /**
     * Get label text
     *
     * @return string|null
     */
    public function getLabelText(): ?string;

    /**
     * Set label text
     *
     * @param string $text
     * @return $this
     */
    public function setLabelText(string $text): static;

    /**
     * Get options
     *
     * @return string|null
     */
    public function getOptions(): ?string;

    /**
     * Set options
     *
     * @param string $options
     * @return $this
     */
    public function setOptions(string $options): static;
}
