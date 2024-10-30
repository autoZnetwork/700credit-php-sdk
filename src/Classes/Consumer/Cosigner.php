<?php

namespace Autoznetwork\Php700Credit\Classes\Consumer;

class Cosigner extends Consumer
{
    public function toArray(): array
    {
        return $this->mapCosignerData(parent::toArray());
    }

    protected function mapCosignerData(array $data): array
    {
        $returnArr = [];

        $mapFields = [
            'NAME' => 'SPOUSE',
            'SSN' => 'SPOUSESSN',
            'DOB' => 'SPOUSEDOB',
            'EMAIL' => 'SPOUSEEMAIL',
            'PHONE' => 'SPOUSEPHONE',
            'ADDRESS' => 'SPOUSEADDRESS',
            'CITY' => 'SPOUSECITY',
            'STATE' => 'SPOUSESTATE',
            'ZIP' => 'SPOUSEZIP',
            'CURRENTADDRESSPERIOD' => 'SPOUSEADDRESSPERIOD',
            'PREVADDRESS' => 'SPOUSEPREVADDRESS',
            'PREVCITY' => 'SPOUSEPREVCITY',
            'PREVSTATE' => 'SPOUSEPREVSTATE',
            'PREVZIP' => 'SPOUSEPREVZIP',
            'PREVADDRESSPERIOD' => 'SPOUSEPREVADDRESSPERIOD',
            'HOUSING' => 'SPOUSEHOUSING',
            'HOUSINGPAY' => 'SPOUSEHOUSINGPAY',
            'EMPLOYER' => 'SPOUSEEMPLOYERNAME',
            'POSITION' => 'SPOUSEOCCUPATION',
            'YEARS' => 'SPOUSEEMPLOYMENTPERIOD',
            'WPHONE' => 'SPOUSEWORKPHONE',
            'MINCOME' => 'SPOUSEINCOME',
            'OTHERINCOME' => 'SPOUSEOTHERINCOME',
            'OTHERINCOMEEXPLN' => 'SPOUSEOTHERINCOMEEXPLN',
            'DRIVERSLICENSENO' => 'SPOUSEDRIVERSLICENSENO',
            'DLEXPIRATION' => 'SPOUSEDLEXPIRATION',
            'DLSTATE' => 'SPOUSEDLSTATE',
            'DLCOUNTY' => 'SPOUSEDLCOUNTY',
        ];

        foreach ($mapFields as $consumerKey => $cosignerKey) {
            $value = $data[$consumerKey] ?? null;

            if (! is_null($value)) {
                $returnArr[$cosignerKey] = $value;
            }
        }

        return $returnArr;
    }
}
