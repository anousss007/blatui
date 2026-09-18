{{-- The `open` prop defaults the panel open so the inbox is visible in the docs. A notification
     with an `href` links to what it is about; `view-all-href` adds the footer link. Pass
     `navigate` to put wire:navigate on both. --}}
<x-ui.notification-center
    open
    view-all-href="#notifications"
    :notifications="[
        ['title' => 'New comment on your post', 'body' => 'Alex Rivera replied: \'This is exactly what I needed, thanks!\'', 'time' => '2 minutes ago', 'read' => false, 'avatar' => 'https://github.com/shadcn.png', 'href' => '#post-comments'],
        ['title' => 'Payment received', 'body' => 'Your invoice #1042 for \$240.00 has been paid.', 'time' => '1 hour ago', 'read' => false, 'icon' => 'credit-card', 'href' => '#invoice-1042'],
        ['title' => 'Deployment successful', 'body' => 'blatui-demo deployed to production in 47s.', 'time' => '3 hours ago', 'read' => true, 'icon' => 'rocket'],
        ['title' => 'Weekly report ready', 'body' => 'Your analytics summary for this week is available.', 'time' => 'Yesterday', 'read' => true, 'icon' => 'chart-line'],
    ]"
/>
