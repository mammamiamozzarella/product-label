<?php

namespace Aurora\ProductLabels\Model;


use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;
use Aurora\ProductLabels\Api\Data\ProductLabelInterfaceFactory;
use Aurora\ProductLabels\Model\ResourceModel\ProductLabel as ProductLabelResource;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;

class ProductLabelRepository implements ProductLabelRepositoryInterface
{
    /**
     * @var ProductLabelInterfaceFactory
     */
    protected ProductLabelInterfaceFactory $productLabelFactory;

    /**
     * @var ProductLabelResource
     */
    protected ProductLabelResource $productLabelResource;

    /**
     * @var ResourceConnection
     */
    protected ResourceConnection $resourceConnection;

    /**
     * @param ProductLabelInterfaceFactory $productLabelFactory
     * @param ProductLabelResource $productLabelResource
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ProductLabelInterfaceFactory $productLabelFactory,
        ProductLabelResource $productLabelResource,
        ResourceConnection $resourceConnection
    ) {
        $this->productLabelFactory = $productLabelFactory;
        $this->productLabelResource = $productLabelResource;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @inheritdoc
     * @throws LocalizedException
     */
    public function assignLabelsToProduct(int $productId, array $labelIds): void
    {
        $connection = $this->resourceConnection->getConnection();
        $table = $this->resourceConnection->getTableName('aurora_product_labels');

        try {
            $connection->beginTransaction();
            $existingLabelIds = $connection->fetchCol(
                $connection->select()
                    ->from($table, 'label_id')
                    ->where('product_id = ?', $productId)
            );

            $newLabelIds = array_diff($labelIds, $existingLabelIds);

            foreach ($newLabelIds as $labelId) {
                if (!empty($labelId)) {
                    $connection->insert($table, [
                        'product_id' => $productId,
                        'label_id'   => (int)$labelId,
                    ]);
                }
            }

            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw new LocalizedException(__('Unable to assign labels to product: %1', $e->getMessage()));
        }
    }

    /**
     * @param int $productId
     * @return array
     */
    public function getLabelsByProductId(int $productId): array
    {
        $connection = $this->resourceConnection->getConnection();

        $productLabelsTable = $this->resourceConnection->getTableName('aurora_product_labels');
        $labelsTable = $this->resourceConnection->getTableName('aurora_labels');

        $select = $connection->select()
            ->from(
                ['apl' => $productLabelsTable],
                ['label_id']
            )
            ->join(
                ['l' => $labelsTable],
                'apl.label_id = l.label_id',
                ['label_text' => 'l.label_text']
            )
            ->where('apl.product_id = :product_id');

        return $connection->fetchAll($select, ['product_id' => $productId]);
    }
}
