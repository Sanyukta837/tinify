<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Compression</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 20px;
  background-color: #f0f0f0;
}

h1 {
  text-align: center;
}

#drop-area {
  border: 2px dashed #ccc;
  padding: 20px;
  text-align: center;
  cursor: pointer;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

#drop-area p {
  margin: 10px 0;
}

#file-input {
  display: none;
}

#file-label {
  display: inline-block;
  margin: 10px 0;
  padding: 8px 16px;
  font-size: 16px;
  color: #2196F3;
  border: 2px solid #2196F3;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s;
}

#file-input:focus + #file-label {
  outline: 2px solid #2196F3;
}

#compress-btn,
#decompress-btn {
  margin-top: 10px;
  padding: 8px 16px;
  font-size: 16px;
  background-color: #2196F3;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s;
}

#compress-btn:disabled,
#decompress-btn:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.drag-over {
  border-color: #2196F3;
}

#download-link {
  display: none;
}

</style>
</head>
<body>
  <h1>File Compression</h1>
  <div id="drop-area">
    <p>Drag and drop files here or</p>
    <label for="file-input" id="file-label">Choose File</label>
    <!-- Change id from "file" to "file-input" -->
    <input type="file" id="file-input">
    <button id="compress-btn" disabled>Compress</button>
    <button id="decompress-btn" disabled>Decompress</button>
    <a id="download-link" download></a>
    <p id="selected-file-name">No file selected</p>
  </div>
  <script src="pako-master/dist/pako.min.js"></script>
  <script >
    document.addEventListener('DOMContentLoaded', () => {
  const dropArea = document.getElementById('drop-area');
  const fileInput = document.getElementById('file-input');
  const compressBtn = document.getElementById('compress-btn');
  const decompressBtn = document.getElementById('decompress-btn');
  const downloadLink = document.getElementById('download-link');
  const selectedFileName = document.getElementById('selected-file-name');

  dropArea.addEventListener('dragover', handleDragOver);
  dropArea.addEventListener('dragleave', handleDragLeave);
  dropArea.addEventListener('drop', handleDrop);

  compressBtn.addEventListener('click', compressFile);
  decompressBtn.addEventListener('click', decompressFile);
  fileInput.addEventListener('change', handleFile);

  function handleDragOver(event) {
    event.preventDefault();
    dropArea.classList.add('drag-over');
  }

  function handleDragLeave(event) {
    event.preventDefault();
    dropArea.classList.remove('drag-over');
  }

  function handleDrop(event) {
    event.preventDefault();
    dropArea.classList.remove('drag-over');
    handleFile(event);
  }

  function handleFile(event) {
    let file;
    if (event.type === 'change') {
      file = event.target.files[0];
    } else if (event.type === 'drop') {
      file = event.dataTransfer.files[0];
    }

    if (file) {
      selectedFileName.textContent = file.name;
      if (file.name.endsWith('.gz')) {
        decompressBtn.disabled = false;
        compressBtn.disabled = true;
        downloadLink.download = file.name.replace('.gz', '');
      } else {
        compressBtn.disabled = false;
        decompressBtn.disabled = true;
        downloadLink.download = file.name + '.gz';
      }
    } else {
      selectedFileName.textContent = 'No file selected';
      compressBtn.disabled = true;
      decompressBtn.disabled = true;
    }
  }

  function compressFile() {
    const file = fileInput.files[0];

    if (file) {
      fetchFileContent(file)
        .then((fileContent) => {
          const compressedContent = pako.gzip(fileContent);
          const compressedBlob = new Blob([compressedContent]);

          downloadLink.href = URL.createObjectURL(compressedBlob);
          downloadLink.click();
        })
        .catch((error) => {
          console.error('Error fetching file content:', error);
        });
    } else {
      alert('Please select a file to compress.');
    }
  }

  function decompressFile() {
    const file = fileInput.files[0];

    if (file) {
      fetchFileContent(file)
        .then((fileContent) => {
          const decompressedContent = pako.ungzip(fileContent);
          const decompressedBlob = new Blob([decompressedContent]);

          downloadLink.href = URL.createObjectURL(decompressedBlob);
          downloadLink.click();
        })
        .catch((error) => {
          console.error('Error fetching file content:', error);
        });
    } else {
      alert('Please select a file to decompress.');
    }
  }

  function fetchFileContent(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();

      reader.onload = function (event) {
        resolve(new Uint8Array(event.target.result));
      };

      reader.onerror = function (event) {
        reject(event.target.error);
      };

      reader.readAsArrayBuffer(file);
    });
  }
});


  </script>
</body>
</html>
