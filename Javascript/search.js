// search.js

document.addEventListener('DOMContentLoaded', function() {
  var searchForm = document.getElementById('search-form');
  var outputDiv = document.getElementById('search-output');
  var gallery = document.getElementById('art-gallery');

  // Function to validate input against the criteria of two words
  function isValidInput(input) {
      return /^[A-Za-z]+(?:\s[A-Za-z]+)?$/.test(input);
  }

  // Function to create a figure with an image and caption
  function createFigure(src, captionText) {
    var figure = document.createElement('figure');
    figure.className = 'art-piece'; // Use this class to apply CSS

    var image = new Image();
    image.src = src;
    image.alt = captionText;
    image.className = 'responsive-image'; // Use this class to apply CSS

    var caption = document.createElement('figcaption');
    caption.textContent = captionText;

    figure.appendChild(image);
    figure.appendChild(caption);

    return figure;
}

  // Fill the gallery with figures (images and captions)
  function fillGallery() {
    // Clear previous results
    gallery.innerHTML = '';

    // Image data and captions, would be loaded from a server based on the input but this is just a demonstration
    var imageData = [
        { src: '../images/highres-henrik-donnestad-t2Sai-AqIpI-unsplash.jpg', caption: 'Photo by Henrik Dønnestad on Unsplash' },
        { src: '../images/highres-mcgill-library-y4PqRPqSako-unsplash.jpg', caption: 'Photo by McGill Library on Unsplash' },
        { src: '../images/highres-steve-johnson-e5LdlAMpkEw-unsplash.jpg', caption: 'Photo by Steve Johnson on Unsplash' },
        
    ];

    // Determine screen size and choose the appropriate image set
     var imageSet = window.innerWidth <= 768 ? '../images/lowres-' : '../images/highres-';
    var imageSet = window.innerWidth;

    // Create and append figure elements to the gallery
    imageData.forEach(function(image) {
        var figure = createFigure(/*imageSet +*/ image.src, image.caption);
        gallery.appendChild(figure);
    });
  }

  // Event listener for the form submission
  searchForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var genre = document.getElementById('search-genre').value.trim();
      var medium = document.getElementById('search-medium').value.trim();

      // Validate inputs
      if (!isValidInput(genre) || !isValidInput(medium)) {
          outputDiv.textContent = 'Please enter two words only for each field, without any numbers or special characters.';
          gallery.innerHTML = ''; // Clear the gallery if input is invalid
          return;
      }

      var searchData = {
          genre: genre,
          medium: medium
      };

      var json = JSON.stringify(searchData);
      outputDiv.textContent = 'JSON to send: ' + json;

      // Fill the gallery with images based on the search
      fillGallery();

      searchForm.reset();
  });

  // Listen for window resize to update images for responsive layout
  window.addEventListener('resize', fillGallery);
});