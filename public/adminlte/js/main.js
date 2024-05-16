let fileChooser = document.querySelector('.file-chooser');

/* Накопление вновь загруженных файлов */
fileChooser.addEventListener('click', function() {
    let inputContainer = document.querySelector('.list-input');
    let imagesContainer = document.querySelector('.list-images');

    const input = document.createElement('input');
    input.type = 'file';
    input.multiple = true;
    input.style.display = 'none';
    input.className = 'input__image';
    input.name = 'product_images[]';

    inputContainer.appendChild(input)

    input.addEventListener('change', function(e) {
        const newFiles = Array.from(e.target.files);
        let overSize = false;
        let filesUrl = JSON.parse(localStorage.getItem('filesUrl'))

        newFiles.forEach(function (file) {
            if (file.size > 1024 * 1024 * 20) {
                alert('Допустимый размер одного файла - 20 МБ');
                overSize = true;
            }
        })

        if (overSize === true) {
            return
        }

        const files = Array.from(imagesContainer.querySelectorAll('.file-item .file-name')).map(file => ({ name: file.textContent }));

        if (files.length + newFiles.length > 10) {
            alert('Можно загрузить не более 10 файлов');
            return;
        }

        newFiles.forEach(function (file) {
            if(filesUrl) {
                filesUrl.push(URL.createObjectURL(file));
            } else {
                filesUrl = [URL.createObjectURL(file)];
            }
            localStorage.setItem('filesUrl', JSON.stringify(filesUrl));
        })

        const allFiles = [...files, ...newFiles];

        displayFiles(allFiles, imagesContainer);
    });

    input.click();
});

/* Отображение загруженных файлов */
function displayFiles(files, imagesContainer) {
    imagesContainer.innerHTML = '';
    let filesUrl = JSON.parse(localStorage.getItem('filesUrl'))

    files.forEach(function (file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        const fileName = document.createElement('a');
        fileName.classList.add('file-name');
        fileName.textContent = file.name;
        fileName.href = filesUrl[files.indexOf(file)]
        fileName.target = '_blank'

        const deleteIcon = document.createElement('span');
        deleteIcon.classList.add('delete-file');
        deleteIcon.innerHTML = '&#10006';
        deleteIcon.style.cursor = 'pointer';
        deleteIcon.addEventListener('click', function() {
            let filesUrl = JSON.parse(localStorage.getItem('filesUrl'))
            const fileIndex = files.indexOf(file);

            files.splice(fileIndex, 1);
            filesUrl.splice(fileIndex, 1)
            displayFiles(files, imagesContainer);
            localStorage.setItem('filesUrl', JSON.stringify(filesUrl));
        });

        fileItem.appendChild(fileName);
        fileItem.appendChild(deleteIcon);
        imagesContainer.appendChild(fileItem);
    })
}

/* Очистка localStorage.removeItem('filesUrl') хранилища при загрузке страницы */
window.addEventListener('beforeunload', function() {
    localStorage.removeItem('filesUrl')
});
