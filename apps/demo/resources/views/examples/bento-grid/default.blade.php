<x-ui.bento-grid :columns="3">
    <x-ui.bento-item
        :colSpan="2"
        title="Unified dashboard"
        description="See orders, revenue, and customers in one place — no tab juggling."
        icon="layout-dashboard"
    />

    <x-ui.bento-item
        :rowSpan="2"
        title="Realtime activity"
        description="Live events stream in as they happen."
        icon="activity"
    >
        <ul class="mt-1 space-y-2 text-sm">
            <li class="text-muted-foreground">New order #4821</li>
            <li class="text-muted-foreground">Refund approved</li>
            <li class="text-muted-foreground">User signed up</li>
        </ul>
    </x-ui.bento-item>

    <x-ui.bento-item
        title="Fast"
        description="Sub-second loads, edge-cached everywhere."
        icon="zap"
    />

    <x-ui.bento-item
        title="Secure"
        description="SSO, audit logs, and granular roles built in."
        icon="shield-check"
    />
</x-ui.bento-grid>
