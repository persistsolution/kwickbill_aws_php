<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Convert Images to PDF & Upload</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
  <h3>Upload Multiple Images</h3>
  <input type="file" id="imageInput" accept="image/*" multiple>
  <br><br>
  <button onclick="convertToPDF()">Convert to PDF, Download & Upload</button>

  <br><br>
  <iframe id="pdfViewer" width="100%" height="600px" style="display:none;"></iframe>

  <script>
    async function convertToPDF() {
      const input = document.getElementById('imageInput');
      const files = input.files;

      if (files.length === 0) return alert("Please upload at least one image.");

      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF();

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const imgData = await readFileAsDataURL(file);
        const img = new Image();
        img.src = imgData;

        await new Promise(resolve => {
          img.onload = () => {
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();

            let imgWidth = img.width;
            let imgHeight = img.height;

            // Calculate scaling
            const widthScale = pageWidth / imgWidth;
            const heightScale = pageHeight / imgHeight;
            const scale = Math.min(widthScale, heightScale);

            const finalWidth = imgWidth * scale;
            const finalHeight = imgHeight * scale;

            // Center image
            const x = (pageWidth - finalWidth) / 2;
            const y = (pageHeight - finalHeight) / 2;

            if (i !== 0) pdf.addPage();
            pdf.addImage(imgData, 'JPEG', x, y, finalWidth, finalHeight);
            resolve();
          };
        });
      }

      // Save to user's device
      pdf.save("pdffiles/converted-images.pdf");

      // Upload to server
      const pdfBlob = pdf.output("blob");
      const formData = new FormData();
      formData.append("file", pdfBlob, "converted-images.pdf");

      fetch("upload.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        // alert("PDF uploaded successfully.");
        // const viewer = document.getElementById('pdfViewer');
        // viewer.src = "pdffiles/converted-images.pdf";  // show uploaded PDF
        // viewer.style.display = 'block';
      })
      .catch(error => {
        console.error("Upload Error:", error);
        alert("PDF upload failed.");
      });
    }

    function readFileAsDataURL(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
      });
    }
  </script>
</body>
</html>
