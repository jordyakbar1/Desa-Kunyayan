import './bootstrap';

import Alpine from 'alpinejs';

// Import all images
import.meta.glob('../images/**/*.{png,jpg,jpeg,gif,svg}');

window.Alpine = Alpine;

Alpine.start();
