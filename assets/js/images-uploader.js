var uploadQueue = [];

function updateGalleryView(e) {
  resetBehaviors(e);
  var listGalleriesNames = document.querySelectorAll('#galleries ul li');
  
  for (var i = 0; i < listGalleriesNames.length; i++) {
    listGalleriesNames[i].classList.remove('active');
  }
  
  e.target.parentElement.classList.remove('active');
  
  var xhr = new XMLHttpRequest();
  
  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      document.getElementById('images-list').innerHTML = xhr.responseText;
      
      updateEventsListeners();
    }
  };
  
  xhr.open('GET', 'images-uploader.php?gallery='+e.target.parentElement.id, true);
  xhr.send(null);
}

var galleriesListDroppableStyle = {
  add: function (e) {
    var galleriesList = document.querySelectorAll('#galleries ul li a');
    e.dataTransfer.setData('id', e.target.id);

    for (var i = 1; i < galleriesList.length; i++) {
      galleriesList[i].parentElement.classList.add('drop-zone');
    }
  },
  
  remove: function () {
    var galleriesList = document.querySelectorAll('#galleries ul li a');
    
    for (var i = 1; i < galleriesList.length; i++) {
      galleriesList[i].parentElement.classList.remove('drop-zone');
    }
  }
};

function handleChangeGallery(e) {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      document.getElementById('images-list').innerHTML = xhr.responseText;
      updateEventsListeners();
    }
  };

  xhr.open('GET', 'images-uploader.php?id='+e.dataTransfer.getData('id')+'&fromgallery='+document.querySelector('.active').id+'&togallery='+e.target.id);
  xhr.send(null);
}

function updateEventsListeners() {
  var galleriesList = document.querySelectorAll('#galleries ul li a'),
      imagesList = document.querySelectorAll('#images-list li');

  for (var i = 0; i < galleriesList.length; i++) {
    galleriesList[i].addEventListener('click', updateGalleryView, false);

    if (i === 0) { continue; }
    
    galleriesList[i].parentElement.addEventListener('dragover', resetBehaviors, false);
    galleriesList[i].parentElement.addEventListener('drop', handleChangeGallery, false);
  }
  
  for (i = 0; i < imagesList.length; i++) {
    imagesList[i].addEventListener('dragstart', galleriesListDroppableStyle.add);
    imagesList[i].addEventListener('dragend', changeClassAll.remove);
  }
}

function formatImagePreview(imageFile) {
  var imageIndex = uploadQueue.indexOf(imageFile),
      imageName = imageFile.name,
      imageSize = formatFileSize(imageFile.size).value,
      imageUnit = formatFileSize(imageFile.size).unit,
      liTag = document.createElement('li');

  liTag.setAttribute('id', 'image-'+imageIndex);
  var imagePreview = document.getElementById('image-preview').appendChild(liTag);

  return function () { imagePreview.innerHTML =
    '<ul>'+
      '<li class="image-thumbnail"><img src="'+URL.createObjectURL(imageFile)+'"></li>'+
      '<li class="image-infos">'+
        '<ul>'+
          '<li class="image-name">'+imageName+'</li>'+
          '<li class="image-size"><span id="upload-progress-size-'+imageIndex+'">0</span> '+imageUnit+' of '+imageSize+' '+imageUnit+'</li>'+
          '<li><progress id="upload-progress-bar-'+imageIndex+'" value="0" max="100"></progress></li>'+
        '</ul>'+
      '</li>'+
    '</ul>';
  };
}

function handleImagePreview(e) {
  resetBehaviors(e);

  var imageFiles = e.target.files || e.dataTransfer.files;

  for (var i = 0; i < imageFiles.length; i++) {
    var imageFile = imageFiles[i],
        reader = new FileReader();
    
    if (!imageFile.type.match('image.*')) { continue; }

    uploadQueue.push(imageFile);

    reader.onloadend = formatImagePreview(imageFile);
    reader.readAsDataURL(imageFile);
  }
}

function handleUpload(e) {
  resetBehaviors(e);
  
  function uploadProgressBarView(index, loadedPercentage, loadedSize) {
    document.getElementById('upload-progress-bar-'+index).value = loadedPercentage;
    document.getElementById('upload-progress-size-'+index).innerHTML = formatFileSize(loadedSize).value;
  }

  uploadQueue.forEach (function(file, i) {
    var uploadFormData = new FormData(),
        xhr = new XMLHttpRequest();
    
    uploadFormData.append('galleries-names', document.getElementById('galleries-names').value);
    uploadFormData.append('upload-input[]', file);

    xhr.upload.addEventListener('progress', function (e) {
      uploadProgressBarView(i, e.loaded/e.total*100, e.loaded);
      document.getElementById('upload-submit').value = 'Uploading...';
    }, false);

    xhr.upload.addEventListener('load', function (e) {
      uploadProgressBarView(i, 100, e.total);
    }, false);

    xhr.addEventListener('readystatechange', function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById('upload-progress-size-'+i).parentElement.innerHTML = 'Successfully uploaded';
        
        var newContent = JSON.parse(xhr.responseText);
        
        for (var j = 0; j < newContent[1].length; j++) {
          var liTag = document.createElement('li'),
              aTag = document.createElement('a');
          
          liTag.id = newContent[1][j];
          liTag.appendChild(aTag);
          aTag.setAttribute('href', '#');
          aTag.innerHTML = newContent[1][j];
          aTag.addEventListener('click', updateGalleryView, false);
          document.getElementById('galleries-list').appendChild(liTag);
        }

        if (inArray(document.querySelector('.active').id, newContent[2])) {
          var newImage = document.createElement('li');

          newImage.innerHTML = newContent[0];
          document.getElementById('images-list').appendChild(newImage);
        }
        
        document.getElementById('image-preview').removeChild(document.getElementById('image-'+i));
        document.getElementById('upload-submit').value = 'Submit';
        
        updateEventsListeners();
      }
    }, false);

    xhr.open('POST', 'images-uploader.php', true);
    xhr.send(uploadFormData);
  });

  uploadQueue = [];
}

document.getElementById('upload-drop-zone').addEventListener('dragenter', resetBehaviors);
document.getElementById('upload-drop-zone').addEventListener('dragover', resetBehaviors);
document.getElementById('upload-drop-zone').addEventListener('drop', handleImagePreview);
document.getElementById('upload-input').addEventListener('change', handleImagePreview);
document.getElementById('upload-submit').addEventListener('click', handleUpload);
updateEventsListeners();
