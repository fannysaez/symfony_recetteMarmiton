import './bootstrap.js';

import { initDarkMode } from './js/theme.js';
import './js/toggle-password.js';
import './js/like.js';

initDarkMode();

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

// Je prends le CSS de Bootstrap
import './vendor/bootstrap/dist/css/bootstrap.min.css';

// Je prends le JS de Bootstrap
import 'bootstrap';

// Et ça, c'est MON css
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
