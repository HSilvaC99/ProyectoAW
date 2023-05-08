<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\ReviewDTO;

class ReviewDAO extends DAO
{
    private const TABLE_NAME = 'reviews';
    private const ID_KEY = 'id';
    private const COMMENT_KEY = 'comment';
    private const REVIEW_KEY = 'review';
    private const DATE_KEY = 'date';
    
    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    
    public function getProductsReviews($productID): array
    {
        $query = "SELECT r.* FROM product_user_reviews pur INNER JOIN reviews r ON pur.review_id = r.id WHERE pur.product_id = :productID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':productID', $productID);
        $statement->execute();

        $results = array();
        $reviewDAO = new ReviewDAO();

        foreach ($statement as $result) {
            array_push($results, $reviewDAO->createDTOFromArray($result));
        }

        return $results;
    }

    public function getProductReviews($productID): array
    {
        $query = "SELECT r.* FROM reviews r INNER JOIN product_user_reviews pur ON pur.review_id = r.id WHERE pur.product_id = :productID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':productID', $productID);
        $statement->execute();

        $results = array();
        $reviewDAO = new ReviewDAO;

        foreach ($statement as $result) {
            array_push($results, $reviewDAO->createDTOFromArray($result));
        }

        return $results;
    }

    public function getReviewAuthor($productID, $reviewID): array
    {
        $query = "SELECT u.* FROM users u INNER JOIN product_user_reviews pur ON pur.user_id = u.id WHERE pur.product_id = :productID AND pur.review_id = :reviewID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':productID', $productID);
        $statement->bindParam(':reviewID', $reviewID);
        $statement->execute();

        $results = array();
        $userDAO = new UserDAO;

        foreach ($statement as $result) {
            array_push($results, $userDAO->createDTOFromArray($result));
        }

        return $results;
    }

    protected function createDTOFromArray($array): DTO
    {
        //var_dump($array);
        $id = $array[self::ID_KEY];
        $comment = $array[self::COMMENT_KEY];
        $review = $array[self::REVIEW_KEY];
        $date = $array[self::DATE_KEY];

    return new ReviewDTO($id, $comment, $review, $date);
    }

    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            //self::ID_KEY => $dto->getID(),
            self::COMMENT_KEY => $dto->getComment(),
            self::REVIEW_KEY => $dto->getReview(),
            self::DATE_KEY => $dto->getDate()
        );

        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }

}

?>
