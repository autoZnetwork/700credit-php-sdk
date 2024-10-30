<?php

namespace Autoznetwork\Php700Credit\Classes\Vehicle;

class VehicleFinancing
{
    public function __construct(
        public ?int $purchasePrice = null,
        public ?float $financeAmount = null,
        public ?float $invoiceAmount = null,
        public ?float $downPayment = null,
        public ?float $unpaidBalance = null,
        public ?float $titleRegistrationFee = null,
        public ?float $additionalItemsAmount = null,
        public ?float $serviceContractAmount = null,
        public ?float $taxAmount = null,
        public ?int $requestedTerm = null,
        public ?int $requestedAmount = null,
        public ?bool $isPrimary = null,
        public ?float $apr = null,
        public ?float $gap = null,
        public ?float $msrp = null,
    ) {}

    public function purchasePrice(int $purchasePrice): static
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    public function financeAmount(float $financeAmount): static
    {
        $this->financeAmount = $financeAmount;

        return $this;
    }

    public function invoiceAmount(float $invoiceAmount): static
    {
        $this->invoiceAmount = $invoiceAmount;

        return $this;
    }

    public function downPayment(float $downPayment): static
    {
        $this->downPayment = $downPayment;

        return $this;
    }

    public function unpaidBalance(float $unpaidBalance): static
    {
        $this->unpaidBalance = $unpaidBalance;

        return $this;
    }

    public function titleRegistrationFee(float $titleRegistrationFee): static
    {
        $this->titleRegistrationFee = $titleRegistrationFee;

        return $this;
    }

    public function additionalItemsAmount(float $additionalItemsAmount): static
    {
        $this->additionalItemsAmount = $additionalItemsAmount;

        return $this;
    }

    public function serviceContractAmount(float $serviceContractAmount): static
    {
        $this->serviceContractAmount = $serviceContractAmount;

        return $this;
    }

    public function taxAmount(float $taxAmount): static
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    public function requestedTerm(int $requestedTerm): static
    {
        $this->requestedTerm = $requestedTerm;

        return $this;
    }

    public function requestedAmount(int $requestedAmount): static
    {
        $this->requestedAmount = $requestedAmount;

        return $this;
    }

    public function isPrimary(bool $isPrimary): static
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    public function apr(float $apr): static
    {
        $this->apr = $apr;

        return $this;
    }

    public function gap(float $gap): static
    {
        $this->gap = $gap;

        return $this;
    }

    public function msrp(float $msrp): static
    {
        $this->msrp = $msrp;

        return $this;
    }
}
