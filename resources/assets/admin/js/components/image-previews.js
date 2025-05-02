// For Main Images
document.getElementById('main_image').addEventListener('change', function (e) {
    let reader = new FileReader();
    reader.onload = function (event) {
        let previewContainer = document.getElementById('preview-main_image');
        previewContainer.innerHTML = '';
        let img = document.createElement('img');
        img.src = event.target.result;
        img.classList.add('w-32', 'h-32', 'object-cover', 'rounded');
        let removeBtn = document.createElement('button');
        removeBtn.innerHTML = 'Remove';
        removeBtn.classList.add('mt-2', 'px-2', 'py-1', 'bg-red-500', 'text-white', 'rounded');
        removeBtn.onclick = function () {
            previewContainer.innerHTML = '';
            document.getElementById('main_image').value = '';
        };
        previewContainer.appendChild(img);
        previewContainer.appendChild(removeBtn);
    }
    reader.readAsDataURL(e.target.files[0]);
});

let galleryInput = document.getElementById('gallery');
let previewContainer = document.getElementById('preview-gallery');
let fileList = [];

galleryInput.addEventListener('change', function (e) {
    fileList.push(...Array.from(e.target.files));

    renderPreviews();
});

function renderPreviews() {
    previewContainer.innerHTML = '';

    fileList.forEach((file) => {
        let reader = new FileReader();
        reader.onload = function (event) {
            let wrapper = document.createElement('div');
            wrapper.classList.add('relative', 'inline-block', 'mr-2', 'mb-2');

            let img = document.createElement('img');
            img.src = event.target.result;
            img.classList.add('w-32', 'h-32', 'object-cover', 'rounded');

            let removeBtn = document.createElement('button');
            removeBtn.innerHTML = 'Remove';
            removeBtn.classList.add('absolute', 'top-0', 'right-0', 'mt-1', 'mr-1', 'px-2', 'py-1', 'bg-red-500', 'text-white', 'rounded');
            removeBtn.onclick = function () {
                // Dynamically find the file index to remove (by reference)
                const idx = fileList.indexOf(file);
                if (idx > -1) fileList.splice(idx, 1);

                updateFileInput();
                renderPreviews(); // re-render all previews
            };

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            previewContainer.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });

    updateFileInput(); // sync the input files
}

function updateFileInput() {
    const dt = new DataTransfer();
    fileList.forEach(f => dt.items.add(f));
    galleryInput.files = dt.files;
}

// document.getElementById('gallery').addEventListener('change', function (e) {
//     let previewContainer = document.getElementById('preview-gallery');
//     previewContainer.innerHTML = '';

//     Array.from(e.target.files).forEach(file => {
//         let reader = new FileReader();
//         reader.onload = function (event) {
//             let wrapper = document.createElement('div');
//             wrapper.classList.add('relative', 'inline-block', 'mr-2', 'mb-2');

//             let img = document.createElement('img');
//             img.src = event.target.result;
//             img.classList.add('w-32', 'h-32', 'object-cover', 'rounded');

//             let removeBtn = document.createElement('button');
//             removeBtn.innerHTML = 'Remove';
//             removeBtn.classList.add('absolute', 'top-0', 'right-0', 'mt-1', 'mr-1', 'px-2', 'py-1', 'bg-red-500', 'text-white', 'rounded');
//             removeBtn.onclick = function () {
//                 wrapper.remove();
//                 // Note: Removing the preview does not remove the file from the input
//                 // To remove the file from the input, you'd need to reset the input or manage files manually
//             };

//             wrapper.appendChild(img);
//             wrapper.appendChild(removeBtn);
//             previewContainer.appendChild(wrapper);
//         };
//         reader.readAsDataURL(file);
//     });
// });

