<?php
class Setting
{
    private $id=null;
    private $tgtmaxcalory = null;
    private $tgtmaxmoney = null;
    private $tgtmailaddress = null;

    public function save()
    {
        $querySetting = new QuerySetting();
        $querySetting->setSetting($this);
        $querySetting->save();
    }

    public function delete()
    {
        $querySetting = new QuerySetting();
        $querySetting->setSetting($this);
        $querySetting->delete();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTgtmaxcalory()
    {
        return $this->tgtmaxcalory;
    }

    public function getTgtmaxmoney()
    {
        return $this->tgtmaxmoney;
    }

    public function getTgtmailaddress()
    {
        return $this->tgtmailaddress;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDate($tgtdate)
    {
        $this->tgtdate = $tgtdate;
    }

    public function setTgtmaxcalory($tgtmaxcalory)
    {
        $this->tgtmaxcalory = $tgtmaxcalory;
    }

    public function setTgtmaxmoney($tgtmaxmoney)
    {
        $this->tgtmaxmoney = $tgtmaxmoney;
    }

    public function setTgtmailaddress($tgtmailaddress)
    {
        $this->tgtmailaddress = $tgtmailaddress;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}
