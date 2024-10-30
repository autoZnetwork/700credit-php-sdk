<?php

namespace Autoznetwork\Php700Credit\Requests;

use Autoznetwork\Php700Credit\Classes\Consumer\Consumer;
use Autoznetwork\Php700Credit\Enums\ProductType;
use Autoznetwork\Php700Credit\Traits\HasRequiredFields;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

abstract class AbstractRequest extends Request implements HasBody
{
    use HasFormBody;
    use HasRequiredFields;

    protected Method $method = Method::POST;

    public ?Consumer $consumer = null;

    protected array $requiredFields = [];

    protected ProductType $productType;

    public function resolveEndpoint(): string
    {
        return '';
    }

    public function getProductType(): ProductType
    {
        return $this->productType;
    }
}
