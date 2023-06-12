import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';
import Swal from "sweetalert2";
import * as FilePond from "filepond";
import de_DE from "filepond/locale/de-de.js";
FilePond.setOptions(de_DE);
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
FilePond.registerPlugin(FilePondPluginFileValidateType);
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
FilePond.registerPlugin(FilePondPluginImagePreview);
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
FilePond.registerPlugin(FilePondPluginFileValidateSize);

import './custom/dark-mode.js';
import './custom/sidebar.js';

window.Alpine = Alpine;
window.Swal = Swal;
window.FilePond = FilePond;

Alpine.start();

import "@sweetalert2/theme-dark/dark.scss";
import "filepond/dist/filepond.min.css";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
