<?php

class Currency
{
    private $allCurrencies = [];
    private $activeCurrency = [
        'UAH' => [
            'txt' => 'Гривня',
            'rate' => 1.00,
            'cc' => 'UAH',
        ]
    ];

    public function __construct()
    {
        if (empty($this->allCurrency)) {
            $api_bank = curl_init("https://bank.gov.ua/NBUStatService/v1/statdirectory/exchangenew?json");
            curl_setopt($api_bank, CURLOPT_RETURNTRANSFER, true);
            $allCurrency = curl_exec($api_bank);
            $allCurrency = json_decode($allCurrency, true);
            $this->allCurrencies = $allCurrency;
        }
    }

    public function getCurrencies()
    {
        return $this->allCurrencies;
    }

    public function getCurrency($cc = [])
    {
        foreach ($this->allCurrencies as $item) {
            if (in_array($item['cc'], $cc)){
                $this->activeCurrency[$item['cc']] = $item;
            }
        }
        return $this->activeCurrency;
    }
}