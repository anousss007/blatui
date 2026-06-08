{{-- out-of-range="flag": dates outside [10–20 Jun] stay selectable but show in red, and picking
     one flags the field invalid (red trigger + error) instead of preventing it. --}}
<x-ui.date-picker name="d" min="2026-06-10" max="2026-06-20" out-of-range="flag" default-month="2026-06-10" />
