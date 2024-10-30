<?php

namespace Autoznetwork\Php700Credit\Classes\Consumer;

use Autoznetwork\Php700Credit\Enums\EmploymentStatus;

class Employer
{
    public function __construct(
        public ?string $name = null,
        public ?EmploymentStatus $status = null,
        public ?string $position = null,
        public ?int $years = null,
        public ?int $months = null,
        public ?string $workPhone = null,
        public ?int $monthlyIncome = null,
        public ?int $otherIncome = null,
        public ?string $otherIncomeExplanation = null,
        public ?string $businessType = null,
        public ?string $occupation = null,
    ) {
        $this->format();
    }

    protected function format(): void
    {
        $this->name = $this->formatName($this->name);
        $this->workPhone = $this->formatPhone($this->workPhone);
    }

    protected function formatName(?string $name): ?string
    {
        if (is_null($name)) {
            return null;
        }

        return preg_replace('/([%&])/', '', $name);
    }

    protected function formatPhone(string $phone): string
    {
        return str_replace('+', '', $phone);
    }
}
