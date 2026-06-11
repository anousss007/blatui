<x-ui.comparison-table
    class="max-w-2xl"
    highlight="Pro"
    :tiers="['Hobby', 'Pro', 'Enterprise']"
    :rows="[
        ['feature' => 'Projects', 'values' => ['3', 'Unlimited', 'Unlimited']],
        ['feature' => 'Custom domains', 'values' => [true, true, true]],
        ['feature' => 'Preview deploys', 'values' => [true, true, true]],
        ['feature' => 'Team seats', 'values' => ['1', '5', 'Unlimited']],
        ['feature' => 'Rollbacks', 'values' => ['3 days', 'Unlimited', 'Unlimited']],
        ['feature' => 'SSO / SAML', 'values' => [false, false, true]],
        ['feature' => 'Audit logs', 'values' => [false, false, true]],
        ['feature' => 'SLA', 'values' => [false, '99.9%', '99.99%']],
    ]"
/>
