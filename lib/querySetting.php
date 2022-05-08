<?php
class QuerySetting extends connect
{
    private $setting;

    public function __construct()
    {
        parent::__construct();
    }

    public function setSetting(Setting $setting)
    {
        $this->setting = $setting;
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
