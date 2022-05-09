<?php
class QuerySearch extends connect
{
    private $search;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 日付パラメータが1個の場合
     * 日付パラメータが2個の場合
     * カテゴリーがある場合
     */
    public function search($from,$to)
    {

        $sql = "select * from records where tgtdate between from=:from and to=:to";

        if(!empty($from) && !empty($to))
        {
            $stmt = $this->dbh->prepare("SELECT * from records WHERE tgtdate BETWEEN :from AND :to order by tgtdate "); 
            $tmpfrom = str_replace('-','/',$from);
            $tmpto=str_replace('-','/',$to);
            $stmt->bindParam(':from', $tmpfrom, PDO::PARAM_STR);
            $stmt->bindParam(':to', $tmpto, PDO::PARAM_STR);
        }
        else if(!empty($from))
        {
            $stmt = $this->dbh->prepare("select * from records where tgtdate > :from order by tgtdate"); 
            $tmpfrom = str_replace('-','/',$from);
            $stmt->bindParam(':from', $tmpfrom, PDO::PARAM_STR);
        }
        else if(!empty($to))
        {
            $stmt = $this->dbh->prepare("select * from records where tgtdate < :to order by tgtdate"); 
            $tmpto=str_replace('-','/',$to);
            $stmt->bindParam(':to', $tmpto, PDO::PARAM_STR);
        }

        // if(!empty($cate) && (!empty($from) || !empty($to)))
        // {
        //     $sql .= " and tgtcategory=".$cate;
        // }
        // else
        // {
        //     $sql .= " tgtcategory=".$cate;
        // }
        $stmt->execute();
        // $stmt->debugDumpParams();
        $setting = $this->getSearchData($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $setting;


    }

    public function save()
    {
        $id = $this->setting->getId();
        $tgtmaxcalory = $this->setting->getTgtmaxcalory();
        $tgtmaxmoney = $this->setting->getTgtmaxmoney();
        $tgtmailaddress = $this->setting->getTgtmailaddress();

        if ($id) 
        {
            // IDがあるときは上書き
            $id = intval($this->setting->getId());

            $stmt = $this->dbh->prepare("UPDATE setting SET tgtmaxcalory=:tgtmaxcalory, tgtmaxmoney=:tgtmaxmoney, tgtmailaddress=:tgtmailaddress,updated_at=NOW() WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
         } 
         else 
         {
            // IDがなければ新規作成
            $stmt = $this->dbh->prepare("INSERT INTO setting (tgtmaxcalory, tgtmaxmoney, tgtmailaddress,created_at, updated_at)
                        VALUES (:tgtmaxcalory, :tgtmaxmoney, :tgtmailaddress, NOW(), NOW())");
        }
        $stmt->bindParam(':tgtmaxcalory', $tgtmaxcalory, PDO::PARAM_INT);
        $stmt->bindParam(':tgtmaxmoney', $tgtmaxmoney, PDO::PARAM_INT);
        $stmt->bindParam(':tgtmailaddress', $tgtmailaddress, PDO::PARAM_STR);
        $stmt->execute();
    }

    private function getSearchData($results)
    {
        $dailies = array();
        foreach ($results as $result) {
            $dailies[]=array("tgtdate"=>$result["tgtdate"],"tgtcategory"=>$result["tgtcategory"],"tgtitem"=>$result["tgtitem"],"tgtmoney"=>$result["tgtmoney"],"tgtcalory"=>$result["tgtcalory"]);
        }

        return  $dailies;
    }

    public function find()
    {
        $stmt = $this->dbh->prepare("SELECT  * FROM setting");
        $stmt->execute();
        $setting = $this->getSettingData($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $setting;
    }

    private function getSettingData($results)
    {
        $setting = "";
        foreach ($results as $result) {
            $setting=array("id"=>$result["id"],"tgtmaxcalory"=>$result["tgtmaxcalory"],"tgtmaxmoney"=>$result["tgtmaxmoney"],"tgtmailaddress"=>$result["tgtmailaddress"]);
        }
        return  $setting;
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
