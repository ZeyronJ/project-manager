import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Datepicker from 'flowbite-datepicker/Datepicker';

import.meta.glob([
    '../images/**',
  ]);

window.Alpine = Alpine;
//window.Datepicker = Datepicker;

Alpine.plugin(focus);

Alpine.start();
