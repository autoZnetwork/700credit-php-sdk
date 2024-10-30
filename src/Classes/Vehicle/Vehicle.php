<?php

namespace Autoznetwork\Php700Credit\Classes\Vehicle;

use Autoznetwork\Php700Credit\Enums\LoanType;
use Autoznetwork\Php700Credit\Traits\Conditionable;

class Vehicle
{
    use Conditionable;

    public function __construct(
        protected ?LoanType $loanType = null,
        protected ?bool $isNew = null,
        protected ?int $year = null,
        protected ?string $make = null,
        protected ?string $model = null,
        protected ?string $exteriorColor = null,
        protected ?string $vin = null,
        protected ?string $stock = null,
        protected ?VehicleFinancing $financing = null,
    ) {}

    public function loanType(LoanType $loanType): static
    {
        $this->loanType = $loanType;

        return $this;
    }

    public function isNew(bool $isNew): static
    {
        $this->isNew = $isNew;

        return $this;
    }

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

    public function exteriorColor(string $exteriorColor): static
    {
        $this->exteriorColor = $exteriorColor;

        return $this;
    }

    public function vin(string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function stock(string $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function financing(VehicleFinancing $financing): static
    {
        $this->financing = $financing;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'LOANTYPE' => $this->loanType->value,
            'ISNEW' => $this->isNew,
            'YEAR' => $this->year,
            'NMAKE' => $this->make,
            'MODEL' => $this->model,
            'EXTERIORCOLOR' => $this->exteriorColor,
            'NVINNUMBER' => $this->vin,
            'STOCKNUMBER' => $this->stock,
            'PURCHASEPRICE' => $this->financing?->purchasePrice,
            'FINANCEAMOUNT' => $this->financing?->financeAmount,
            'INVOICEAMOUNT' => $this->financing?->invoiceAmount,
            'DOWNPAYMENT' => $this->financing?->downPayment,
            'UNPAIDBALANCE' => $this->financing?->unpaidBalance,
            'TITLEREGISTRATIONFEE' => $this->financing?->titleRegistrationFee,
            'ADDITIONALITEMSAMOUNT' => $this->financing?->additionalItemsAmount,
            'SERVICECONTRACTAMOUNT' => $this->financing?->serviceContractAmount,
            'TAXAMOUNT' => $this->financing?->taxAmount,
            'REQTERM' => $this->financing?->requestedTerm,
            'REQAMOUNT' => $this->financing?->requestedAmount,
            'ISPRIMARY' => $this->financing?->isPrimary,
            'APR' => $this->financing?->apr,
            'GAP' => $this->financing?->gap,
            'MSRP' => $this->financing?->msrp,
        ]);
    }
}
