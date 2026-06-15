{{-- The `open` prop defaults the panel open so the inbox is visible in the docs. --}}
<x-ui.notification-center
    open
    :notifications="[
        ['title' => 'New comment on your post', 'body' => 'Alex Rivera replied: \'This is exactly what I needed, thanks!\'', 'time' => '2 minutes ago', 'read' => false, 'avatar' => 'https://github.com/shadcn.png'],
        ['title' => 'Payment received', 'body' => 'Your invoice #1042 for \$240.00 has been paid.', 'time' => '1 hour ago', 'read' => false, 'icon' => 'credit-card'],
        ['title' => 'Deployment successful', 'body' => 'blatui-demo deployed to production in 47s.', 'time' => '3 hours ago', 'read' => true, 'icon' => 'rocket'],
        ['title' => 'Weekly report ready', 'body' => 'Your analytics summary for this week is available.', 'time' => 'Yesterday', 'read' => true, 'icon' => 'chart-line'],
    ]"
/>
