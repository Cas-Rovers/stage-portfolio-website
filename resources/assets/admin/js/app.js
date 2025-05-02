import tinymce from 'tinymce';
import './bootstrap';

import.meta.glob([
    '../media/**'
]);

const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';


document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (form.querySelector('.tox-tinymce')) {
            tinymce.triggerSave();
        }

        const submitButton = event.submitter;

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            submitButton.innerHTML = `<span class="animate-spin mr-2 inline-block w-4 h-4 border-2 border-t-transparent border-white rounded-full"></span>`;
        }
    })
});

tinymce.init({
    selector: '#editor',
    plugins: [
        'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'emoticons',
        'anchor', 'searchreplace', 'code', 'table', 'insertdatetime',
        'media', 'directionality'
    ],
    toolbar: [
        { name: 'history', items: ['undo', 'redo'] },
        { name: 'styles', items: ['styles', 'formatselect'] },
        { name: 'formatting', items: ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript'] },
        { name: 'alignment', items: ['alignleft', 'aligncenter', 'alignright', 'alignjustify'] },
        { name: 'lists', items: ['bullist', 'numlist'] },
        { name: 'links', items: ['link', 'unlink', 'anchor'] },
        { name: 'insert', items: ['image', 'media'] },
        { name: 'indentation', items: ['outdent', 'indent'] },
        { name: 'format', items: ['fontselect', 'fontsizeselect', 'forecolor', 'backcolor'] },
        { name: 'tools', items: ['code'] },
        { name: 'table', items: ['table'] },
        { name: 'directionality', items: ['ltr', 'rtl'] },
        { name: 'insert', items: ['charmap', 'emoticons', 'hr', 'insertdatetime'] }
    ],
    toolbar_mode: 'sliding',
    skin: isDarkMode ? 'oxide-dark' : 'oxide',
    content_css: isDarkMode ? 'dark' : 'default',
    license_key: 'gpl'
});
