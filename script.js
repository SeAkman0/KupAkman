const moveStep = 10; // Her adımda ne kadar hareket edeceği (px cinsinden)
const sizeStep = 10; // Boyut değişikliklerinde adım miktarı (px cinsinden)
const rotateStep = 15; // Rotasyon adımı (derece cinsinden)

let currentImageLeft = null;
let currentImageRight = null;
let currentRotationLeft = 0;
let currentRotationRight = 0;

// Sol kupa için dosya yükleme
document.getElementById('image-input-left').addEventListener('change', function(event) {
    handleFileSelect(event, 'left');
});

// Sağ kupa için dosya yükleme
document.getElementById('image-input-right').addEventListener('change', function(event) {
    handleFileSelect(event, 'right');
});

function handleFileSelect(event, side) {
    const file = event.target.files[0];
    if (file) {
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(file.type)) {
            alert('Desteklenmeyen dosya türü. Lütfen bir resim dosyası yükleyin.');
            return;
        }

        const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSizeInBytes) {
            alert('Dosya boyutu çok büyük. Lütfen daha küçük bir dosya yükleyin.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('user-image');
            img.style.top = '50px';
            img.style.left = '50px';
            img.style.transform = 'rotate(0deg)';
            img.addEventListener('click', () => selectImage(img, side));

            if (side === 'left') {
                document.getElementById('cup-container-left').appendChild(img);
                selectImage(img, 'left');
            } else {
                document.getElementById('cup-container-right').appendChild(img);
                selectImage(img, 'right');
            }
        };
        reader.onerror = function(e) {
            console.error('Dosya okunamadı: ', e);
            alert('Dosya okunamadı. Lütfen başka bir dosya deneyin.');
        };
        reader.readAsDataURL(file);
    }
}

function selectImage(img, side) {
    if (side === 'left') {
        if (currentImageLeft) {
            currentImageLeft.style.border = 'none';
        }
        currentImageLeft = img;
        currentImageLeft.style.border = '2px solid red';
        currentRotationLeft = parseInt(currentImageLeft.style.transform.replace('rotate(', '').replace('deg)', '')) || 0;
    } else {
        if (currentImageRight) {
            currentImageRight.style.border = 'none';
        }
        currentImageRight = img;
        currentImageRight.style.border = '2px solid red';
        currentRotationRight = parseInt(currentImageRight.style.transform.replace('rotate(', '').replace('deg)', '')) || 0;
    }
}

document.querySelectorAll('.up-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        moveImage(side, 'up');
    });
});

document.querySelectorAll('.down-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        moveImage(side, 'down');
    });
});

document.querySelectorAll('.left-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        moveImage(side, 'left');
    });
});

document.querySelectorAll('.right-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        moveImage(side, 'right');
    });
});

document.querySelectorAll('.increase-size-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        resizeImage(side, 'increase');
    });
});

document.querySelectorAll('.decrease-size-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        resizeImage(side, 'decrease');
    });
});

document.querySelectorAll('.rotate-left-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        rotateImage(side, 'left');
    });
});

document.querySelectorAll('.rotate-right-button').forEach(button => {
    button.addEventListener('click', function() {
        const side = button.getAttribute('data-side');
        rotateImage(side, 'right');
    });
});

function moveImage(side, direction) {
    const currentImage = side === 'left' ? currentImageLeft : currentImageRight;
    if (currentImage) {
        let top = parseInt(window.getComputedStyle(currentImage).top);
        let left = parseInt(window.getComputedStyle(currentImage).left);
        switch (direction) {
            case 'up':
                currentImage.style.top = (top - moveStep) + 'px';
                break;
            case 'down':
                currentImage.style.top = (top + moveStep) + 'px';
                break;
            case 'left':
                currentImage.style.left = (left - moveStep) + 'px';
                break;
            case 'right':
                currentImage.style.left = (left + moveStep) + 'px';
                break;
        }
    }
}

function resizeImage(side, action) {
    const currentImage = side === 'left' ? currentImageLeft : currentImageRight;
    if (currentImage) {
        let width = parseInt(window.getComputedStyle(currentImage).width);
        switch (action) {
            case 'increase':
                currentImage.style.width = (width + sizeStep) + 'px';
                break;
            case 'decrease':
                currentImage.style.width = (width - sizeStep) + 'px';
                break;
        }
    }
}

function rotateImage(side, direction) {
    const currentImage = side === 'left' ? currentImageLeft : currentImageRight;
    if (currentImage) {
        let currentRotation = side === 'left' ? currentRotationLeft : currentRotationRight;
        switch (direction) {
            case 'left':
                currentRotation -= rotateStep;
                break;
            case 'right':
                currentRotation += rotateStep;
                break;
        }
        currentImage.style.transform = `rotate(${currentRotation}deg)`;
        if (side === 'left') {
            currentRotationLeft = currentRotation;
        } else {
            currentRotationRight = currentRotation;
        }
    }
}


