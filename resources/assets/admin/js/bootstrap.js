import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { Livewire, Alpine } from '@livewire';
Livewire.start()

import tinymce from 'tinymce';
import '../../../../node_modules/tinymce/models/dom/model';
import '../../../../node_modules/tinymce/themes/silver/theme';
import '../../../../node_modules/tinymce/icons/default/icons';
import '../../../../node_modules/tinymce/skins/ui/oxide/skin';
import '../../../../node_modules/tinymce/skins/ui/oxide/content';
import '../../../../node_modules/tinymce/skins/ui/oxide-dark/skin';
import '../../../../node_modules/tinymce/skins/ui/oxide-dark/content';
import '../../../../node_modules/tinymce/skins/content/default/content';
import '../../../../node_modules/tinymce/skins/content/dark/content';

// plugins
import '../../../../node_modules/tinymce/plugins/advlist/plugin';
import '../../../../node_modules/tinymce/plugins/anchor/plugin';
import '../../../../node_modules/tinymce/plugins/autolink/plugin';
import '../../../../node_modules/tinymce/plugins/charmap/plugin';
import '../../../../node_modules/tinymce/plugins/code/plugin';
import '../../../../node_modules/tinymce/plugins/directionality/plugin';
import '../../../../node_modules/tinymce/plugins/emoticons/plugin';
import '../../../../node_modules/tinymce/plugins/emoticons/js/emojis';
import '../../../../node_modules/tinymce/plugins/image/plugin';
import '../../../../node_modules/tinymce/plugins/insertdatetime/plugin';
import '../../../../node_modules/tinymce/plugins/link/plugin';
import '../../../../node_modules/tinymce/plugins/lists/plugin';
import '../../../../node_modules/tinymce/plugins/media/plugin';
import '../../../../node_modules/tinymce/plugins/searchreplace/plugin';
import '../../../../node_modules/tinymce/plugins/table/plugin';

window.tinymce = tinymce;
