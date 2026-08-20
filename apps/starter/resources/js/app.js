// Charts first — see the note in charts.js: blatui.js boots Alpine as it evaluates, so the
// dashboard's chart helpers have to be on window before that happens.
import './charts.js';

// BlatUI engine: boots Alpine and registers the components.
import './blatui.js';
