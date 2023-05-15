<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserReviewDTO;

class UserReviewDAO extends DAO
{
    private const TABLE_NAME = 'product_user_reviews';
    private const REVIEWID_KEY = 'review_id';
    private const PRODUCTID_KEY = 'product_id';
    private const USERID_KEY = 'user_id';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    protected function createDTOFromArray($array): DTO
    {
        $userID = $array[self::USERID_KEY];
        $productID = $array[self::PRODUCTID_KEY];
        $reviewID = $array[self::REVIEWID_KEY];

        return new UserReviewDTO($userID, $productID, $reviewID);
    }
    
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::REVIEWID_KEY => $dto->getReviewID(),
            self::PRODUCTID_KEY => $dto->getProductID(),
            self::USERID_KEY => $dto->getUserID()
        );
    }
}
?>