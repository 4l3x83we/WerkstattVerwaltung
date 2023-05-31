import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';
import Swal from "sweetalert2";

import './custom/dark-mode.js';
import './custom/sidebar.js';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

import "@sweetalert2/theme-dark/dark.scss";
