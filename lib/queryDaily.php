<?php
class QueryDaily extends connect
{
    private $daily;

    public function __construct()
    {
        parent::__construct();
    }

    public function setDaily(Daily $daily)
    {
        $this->daily = $daily;
    }

    public function save()
    {
        $id = $this->daily->getId();
        $tgtdate = $this->daily->getDate();
        $tgtcategory = $this->daily->getCategory();
        $tgtitem = $this->daily->getItem();
        $tgtmoney = $this->daily->getMoney();
        $tgtcalory = $this->daily->getCalory();

        if ($this->daily->getId()) {
            // IDがあるときは上書き
            $id = $this->daily->getId();

            $stmt = $this->dbh->prepare("UPDATE records
            SET tgtdate=:tgtdate, tgtcategory=:tgtcategory, tgtitem=:tgtitem, tgtmoney=:tgtmoney, tgtcalory=:tgtcalory,updated_at=NOW() WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
         } else {
            // IDがなければ新規作成
            $stmt = $this->dbh->prepare("INSERT INTO records (tgtdate, tgtcategory, tgtitem, tgtmoney, tgtcalory,created_at, updated_at)
                        VALUES (:tgtdate, :tgtcategory, :tgtitem, :tgtmoney,:tgtcalory, NOW(), NOW())");
        }
        $stmt->bindParam(':tgtdate', $tgtdate, PDO::PARAM_STR);
        $stmt->bindParam(':tgtcategory', $tgtcategory, PDO::PARAM_STR);
        $stmt->bindParam(':tgtitem', $tgtitem, PDO::PARAM_STR);
        $stmt->bindParam(':tgtmoney', $tgtmoney, PDO::PARAM_INT);
        $stmt->bindParam(':tgtcalory', $tgtcalory, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function searchArticle($word)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE body like :word AND is_delete=0");
        $params = [
            ':word' => '%' . $word . '%',
        ];
        $stmt->execute($params);
        $pager['articles'] = $this->getArticles($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $pager;
    }

    public function find($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE id=:id AND is_delete=0");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $articles = $this->getArticles($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $articles[0];
    }

    public function findAll()
    {
        $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE is_delete=0 ORDER BY title DESC");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = $this->getArticles($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $articles;
    }

    public function getPager($page = 1, $limit = 20, $month = null)
    {
        $start = ($page - 1) * $limit; // LIMIT x, y：1ページ目を表示するとき、xは0になる
        $pager = array('total' => null, 'articles' => null);
        // 月指定があれば「2021-01%」のように検索できるよう末尾に追加 アーカイブ欄から渡される模様
        if ($month) {
            $month .= '%';
        }
        // 総記事数
        if ($month) {
            $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM articles WHERE is_delete=0 AND title LIKE :month");
            $stmt->bindParam(':month', $month, PDO::PARAM_STR);
        } else {
            $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM articles WHERE is_delete=0");
        }
        $stmt->execute();
        $pager['total'] = $stmt->fetchColumn();

        // 表示するデータ
        if ($month) {
             $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE is_delete=0 AND title LIKE :month ORDER BY title DESC LIMIT :start, :limit");
            $stmt->bindParam(':month', $month, PDO::PARAM_STR);
        } else {
            $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE is_delete=0 ORDER BY title DESC LIMIT :start, :limit");
        }
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $pager['articles'] = $this->getArticles($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $pager;
    }

    public function getMonthlyArchiveMenu()
    {
        $stmt = $this->dbh->prepare("
          SELECT DATE_FORMAT(title, '%Y-%m') AS month_menu, COUNT(*) AS count
          FROM articles
          WHERE is_delete = 0
          GROUP BY DATE_FORMAT(title, '%Y-%m')
          ORDER BY month_menu DESC");
        $stmt->execute();
        $return = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $return[] = array('month' => $row['month_menu'], 'count' => $row['count']);
        }
        return $return;
    }

    private function getArticles($results)
    {
        $articles = array();
        foreach ($results as $result) {
            $article = new Article();
            $article->setId($result['id']);
            $article->setTitle($result['title']);
            $article->setBody($result['body']);
            $article->setFilename($result['filename']);
            $article->setCategoryId($result['category_id']);
            $article->setCreatedAt($result['created_at']);
            $article->setUpdatedAt($result['updated_at']);
            $articles[] = $article;
        }
        return $articles;
    }

    public function delete()
    {
        if ($this->article->getId()) {
            $id = $this->article->getId();
            $stmt = $this->dbh->prepare("UPDATE articles SET is_delete=1 WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}
