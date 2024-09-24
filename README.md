# 700 Credit PHP SDK

For example usage visit [https://docs.autoznetwork.com](https://docs.autoznetwork.com)

## Environment Variables

```php
AUTOZNETWORK_API_TOKEN= // Required

AUTOZNETWORK_CLIENT_ID= // Required for Oauth
AUTOZNETWORK_CLIENT_SECRET= // Required for Oauth
AUTOZNETWORK_REDIRECT_URL="https://yourdomain.com/autoznetwork/callback" // Required for Oauth
AUTOZNETWORK_AUTH_URL="https://autoznetwork.com" // Not Required - for Oauth

AUTOZNETWORK_API_URL= // Not Required
```

## Basic API Token Usage

```php
$autoZnetwork = new AutozNetwork('API TOKEN');
$organizationId = '12345';

$inventory = $autoZnetwork
                ->withOrganization($organizationId)
                ->inventory()
                ->all();
```
