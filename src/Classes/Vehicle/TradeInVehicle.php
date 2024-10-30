<?php

namespace Autoznetwork\Php700Credit\Classes\Vehicle;

use Autoznetwork\Php700Credit\Traits\Conditionable;

class TradeInVehicle
{
    use Conditionable;

    public function __construct(
        protected ?int $year = null,
        protected ?string $make = null,
        protected ?string $model = null,
        protected ?int $mileage = null,
        protected ?float $tradeAllowance = null,
        protected ?float $downPayment = null,
        protected ?bool $isFinanced = null,
        protected ?string $financialInstitution = null,
        protected ?float $payoffAmount = null,
        protected ?float $monthlyPayment = null,
    ) {}

    public function year(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function make(string $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function model(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function mileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function tradeAllowance(float $tradeAllowance): static
    {
        $this->tradeAllowance = $tradeAllowance;

        return $this;
    }

    public function downPayment(float $downPayment): static
    {
        $this->downPayment = $downPayment;

        return $this;
    }

    public function isFinanced(bool $isFinanced): static
    {
        $this->isFinanced = $isFinanced;

        return $this;
    }

    public function financialInstitution(string $financialInstitution): static
    {
        $this->financialInstitution = $financialInstitution;

        return $this;
    }

    public function payoffAmount(float $payoffAmount): static
    {
        $this->payoffAmount = $payoffAmount;

        return $this;
    }

    public function monthlyPayment(float $monthlyPayment): static
    {
        $this->monthlyPayment = $monthlyPayment;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'TRADEINMFGYEAR' => $this->year,
            'TRADEINMAKE' => $this->make,
            'TRADEINMODEL' => $this->model,
            'MILEAGE' => $this->mileage,
            'TRADEALLOWANCE' => $this->tradeAllowance,
            'TRADEINDOWNPAYMENT' => $this->downPayment,
            'ISFINANCED' => $this->isFinanced,
            'FINANCIALINSTITUTION' => $this->financialInstitution,
            'TRADEPAYOFFAMOUNT' => $this->payoffAmount,
            'TRADEMONTHLYPAY' => $this->monthlyPayment,
        ]);
    }
}
