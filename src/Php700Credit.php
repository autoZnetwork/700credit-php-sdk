<?php

namespace Autoznetwork\Php700Credit;

use Autoznetwork\Php700Credit\Classes\Consumer;
use Autoznetwork\Php700Credit\Enums\Bureau;
use Autoznetwork\Php700Credit\Enums\Environment;
use Autoznetwork\Php700Credit\Resources\PreQualifyResource;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Connector;
use Saloon\Traits\Body\HasFormBody;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Php700Credit extends Connector implements HasBody
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use HasFormBody;

    //    protected Environment $environment = Environment::PRODUCTION;
    protected Environment $environment = Environment::TESTING;

    protected ?Consumer $consumer = null;

    protected array $bureaus = [];

    /**
     * By default, 700Credit will check for duplicates before sending. Enabling this will bypass the default logic and
     * send the request directly to the bureau(s).
     */
    protected bool $bypassDuplicateCheck = false;

    public function __construct(protected string $account, protected string $password) {}

    public function resolveBaseUrl(): string
    {
        return $this->environment === Environment::PRODUCTION
            ? Config::$productionUrl
            : Config::$testUrl;
    }

    protected function defaultBody(): array
    {
        return $this->buildConnectorBody();
    }

    public function consumer(Consumer $consumer): self
    {
        $this->consumer = $consumer;

        return $this;
    }

    public function bureaus(array|Bureau $bureaus): self
    {
        if (! is_array($bureaus)) {
            $bureaus = [$bureaus];
        }

        $this->bureaus = $bureaus;

        return $this;
    }

    public function testing(): self
    {
        $this->environment = Environment::TESTING;

        return $this;
    }

    public function bypassDuplicateCheck(): self
    {
        $this->bypassDuplicateCheck = true;

        return $this;
    }

    public function getConsumer(): ?Consumer
    {
        return $this->consumer;
    }

    public function getBureaus(): array
    {
        return $this->bureaus;
    }

    public function preQualify(): PreQualifyResource
    {
        return new PreQualifyResource($this);
    }

    protected function buildConnectorBody(): array
    {
        $body = [
            'ACCOUNT' => $this->account,
            'PASSWD' => $this->password,
            'PASS' => 2,
            'PROCESS' => 'PCCCREDIT',
        ];

        if ($this->bypassDuplicateCheck) {
            $body['APP_MODIFIED'] = 'Y';
        }

        if (count($this->bureaus) > 0) {
            $bureaus = array_map(fn (Bureau $bureau) => $bureau->value, $this->bureaus);
            $body['BUREAUS'] = implode(':', $bureaus);
        }

        return $body;
    }
}
