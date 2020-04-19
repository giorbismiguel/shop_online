<?php

class RateModel extends Model
{
    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var int
     */
    private $productId;

    /**
     * @var int
     */
    private $score;

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @param $sessionId
     * @param $productId
     *
     * @return bool|mixed
     * @throws Exception
     */
    public function getRateBy($sessionId, $productId)
    {
        $sql = 'select id from ratings where session_id = ? and product_id = ?';
        $this->setSql($sql);
        $product = $this->getRow([$sessionId, $productId]);

        if (empty($product)) {
            return false;
        }

        return $product;
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $sql = 'INSERT INTO ratings(session_id, product_id, score) VALUES(?, ?, ?)';
        $data = [
            $this->sessionId,
            $this->productId,
            $this->score,
        ];

        $sth = $this->db->prepare($sql);
        return $sth->execute($data);
    }
}
