<!DOCTYPE html>
<html>
<head>
  <title>File Compression</title>
  
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/styl.css">
  <script defer src="scripts/theme.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<style>
   
    body {
      background: linear-gradient(to bottom right, #ff966d, #fa538d, #89379c);
      height: 100vh;
      
      
    }
    
    h1 {
  text-align: center;
}
.main{
  display: flex;
  align-items: center;
  justify-content: center;
  height: 70vh;
}

#drop-area {
  border: 2px dashed #ccc;
  padding: 20px;
  text-align: center;
  cursor: pointer;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  height: 40vh;
}
.wrapper{
  width: 450px;
  height: 288px;
  padding: 30px;
  background: #fff;
  border-radius: 9px;
  transition: height 0.2s ease;
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

/* #compress-btn:hover,
#decompress-btn:hover {
  background-color: #0d8ce5;
} */

.drag-over {
  border-color: #2196F3;
}

#download-link {
  display: none;
}
  
  </style>
<body>
<nav class="navbar">
    <ul class="navbar-nav">
      <li class="logo">
        <a href="#" class="nav-link">
          <span class="link-text logo-text">TinyFy</span>
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="angle-double-right"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"
            class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
        </a>
      </li>

      <li class="nav-item">
        <a href="user.php" class="nav-link">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="alien-monster"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="svg-inline--fa fa-alien-monster fa-w-18 fa-9x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"
                class="fa-secondary"
              ></path>
            
            </g>
          </svg>
          <span class="link-text">About</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="alien-monster"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="svg-inline--fa fa-alien-monster fa-w-18 fa-9x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120z"
                class="fa-secondary"
              ></path>
              
            </g>
          </svg>
          <span class="link-text">Text File</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="loginpage.php" class="nav-link">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="space-station-moon-alt"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"
                class="fa-secondary"
              ></path>
              
            </g>
          </svg>
          <span class="link-text">Login</span>
        </a>
      </li>

      <li class="nav-item" id="themeButton">
        <a href="#" class="nav-link">
          <svg
            class="theme-icon"
            id="lightIcon"
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="moon-stars"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-moon-stars fa-w-16 fa-7x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M320 32L304 0l-16 32-32 16 32 16 16 32 16-32 32-16zm138.7 149.3L432 128l-26.7 53.3L352 208l53.3 26.7L432 288l26.7-53.3L512 208z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M332.2 426.4c8.1-1.6 13.9 8 8.6 14.5a191.18 191.18 0 0 1-149 71.1C85.8 512 0 426 0 320c0-120 108.7-210.6 227-188.8 8.2 1.6 10.1 12.6 2.8 16.7a150.3 150.3 0 0 0-76.1 130.8c0 94 85.4 165.4 178.5 147.7z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <svg
            class="theme-icon"
            id="solarIcon"
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="sun"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-sun fa-w-16 fa-7x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M502.42 240.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.41-94.8a17.31 17.31 0 0 0-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4a17.31 17.31 0 0 0 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.41-33.5 47.3 94.7a17.31 17.31 0 0 0 31 0l47.31-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3a17.33 17.33 0 0 0 .2-31.1zm-155.9 106c-49.91 49.9-131.11 49.9-181 0a128.13 128.13 0 0 1 0-181c49.9-49.9 131.1-49.9 181 0a128.13 128.13 0 0 1 0 181z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M352 256a96 96 0 1 1-96-96 96.15 96.15 0 0 1 96 96z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <svg
            class="theme-icon"
            id="darkIcon"
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="sunglasses"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="svg-inline--fa fa-sunglasses fa-w-18 fa-7x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"
                class="fa-secondary"
              ></path>
            </g>
          </svg>
          <span class="link-text">Themify</span>
        </a>
      </li>
    </ul>
  </nav>
 
  <main>
    <h1>File Compression</h1>
    <div class="main">
  <div id="drop-area" class="wrapper">
    <p>Drag and drop files here or</p>
    <label for="file-input" id="file-label">Choose File</label>
   
    <input type="file" id="file-input">
    <button id="compress-btn" disabled>Compress</button>
    <button id="decompress-btn" disabled>Decompress</button>
    <a id="download-link" download></a>
    <p id="selected-file-name">No file selected</p>
  </div>
  <div>
</main>
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
